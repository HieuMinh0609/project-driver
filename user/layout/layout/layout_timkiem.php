<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Flowers.com</title>
	<link rel="stylesheet" href="../../bootstrap/css/style.css">
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../bootstrap/js/bootstrap.min.js">
	<script src="../../bootstrap/js/jquery-3.4.1.min.js"></script>
	 <script src="../../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	
	<?php include_once('../include/header.php') ?>
	<?php 
		include_once ('../../lib/db.php');
		include_once ('../../lib/controls.php');
		include_once ('../../lib/auth.php');

		$name_product = $_GET['name'];
		$con =db_connect();
		
		$result = Total_TimkiemSanPham($con, $name_product);
		$row = mysqli_fetch_assoc($result);
		$total_records = $row['total'];

		$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$limit = 16;

		$total_page = ceil($total_records / $limit);

		
		if ($current_page > $total_page){
		    $current_page = $total_page;
		}
		else if ($current_page < 1){
		    $current_page = 1;
		}

		$start = ($current_page - 1) * $limit;

		$result = Timkiem_SanPham($con,$name_product,$start,$limit);
		echo "<script>  	
				 	$('.input_timkiem').val('$name_product');
				 </script>";			
			
	?>
	

	<hr>
	<div class="center-full-fastfood container-fluid">
		
		<div class="danhsach row">
	
			<?php while ($dong = mysqli_fetch_array($result)) {
			?>	
			<div class="col-md-3">
				<div class="product">
					<form action="" method="POST">						
				<a href="../product/product-detail.php?action=detail&id=<?php echo $id_product?>">
					<img src="../../image/<?php echo $dong['image']; ?>" alt=""></a><br>
				<?php $id_product= $dong['idproduct'];?>
				<a href="../product/product-detail.php?action=detail&id=<?php echo $id_product?>">
					<span class="product-name"><?php echo substr($dong['name'],0,20) ; ?></span></a><br>
				<span class="product-price-khuyenmai">
					<?php $promotion=$dong['sell']*(100-$dong['promotion'])/100;
					echo number_format($promotion) ; ?> đ
				</span>
				<span class="product-price"><?php echo number_format($dong['sell']) ; ?> đ</span>	<br> <br>
				
				<a href="layout_timkiem.php?action=add&id=<?php echo $id_product?>&promotion=<?php echo $promotion ?>&name=<?php echo $name_product ?>" class="themgiohang">Thêm vào giỏ hàng</a>
			</form>
					
				</div>
			</div>

			<?php } 		
		if(isset($_GET['action']) && $_GET['action']=="add"){
			if(getLoggedInUser() !=''){
				$id_product=intval($_GET['id']);
				$promotion=intval($_GET['promotion']);
				echo $id_product;
				if(checkCart($con, $id_user, $id_product)==0){
					echo "create";
					echo $promotion;
					createCart($con,$id_user,$id_product,$promotion);
				}
				else{
					$row = getAmount($con, $id_user, $id_product);
					while ($dong = mysqli_fetch_array($row)) {
						$amount = $dong['amount'];
					}
					echo "update";
					$amount = $amount +1;
					$sell =$promotion * $amount;
					
					updateCart($con, $id_user, $id_product, $amount,$sell);	
				}
				
				echo "<script>  	
					 	window.location.href = 'layout_timkiem.php?name=$name_product';

					 </script>";			
				
				echo "<script>  	
				 	$('.input_timkiem').val('$name_product');
				 </script>";
			}
				else {
					 echo "<script> 
					 	window.location.href = '../../../login/login.php';
					 								 </script>";
				}
				echo "<script> 							 	
					 	location.reload();
					 </script>";	
			}
		
		db_close($con);	
	?>


			
			
	    </div>
	</div>
	<div class="pagination">
   <?php 
    
	    if ($current_page > 1 && $total_page > 1){
	    	$input_timkiem =$_GET['name'];
	    	
	       echo '<a href="layout_timkiem.php?name='.$input_timkiem.'&page='.($current_page-1).'">Prev</a> ';
	    }

	    
	    for ($i = 1; $i <= $total_page; $i++){
	        
	       		$input_timkiem =$_GET['name'];
	            
	            echo '<a href="layout_timkiem.php?name='.$input_timkiem.'&page='.($i).'">'.$i.'</a> ';
	        
	    }

	    
	    if ($current_page < $total_page && $total_page > 1){

	    	$input_timkiem =$_GET['name'];
	    	
	       echo '<a href="layout_timkiem.php?name='.$input_timkiem.'&page='.($current_page+1).'">Next</a> ';
	    }
	   ?>
	</div>
    <br>
	<hr>
	</div>
	<?php 
			include_once ('../../lib/db.php');
			include_once ('../../lib/controls.php');
			include_once ('../../lib/cart_service.php');
			$con =db_connect();
			if(isset($_POST['submit_timkiem'])){
				$input_timkiem = $_POST['input_timkiem'];
				$result_tksp = Total_TimkiemSanPham($con, $input_timkiem);
				$row_tksp = mysqli_fetch_assoc($result_tksp);
				$total_records_tksp = $row_tksp['total'];
				echo $total_records_tksp;
				if($input_timkiem != ''){
					
					if($total_records_tksp != 0){
						echo "<script>  	
					 		window.location.href = 'layout_timkiem.php?name=$input_timkiem';
					 	</script>";
					 	
					}
					else{
						echo "<script>  	
					 	window.location.href = 'layout.php';
					 </script>";
					 
					}

					
				}	
				else{
					echo "<script>  	
					 	window.location.href = 'layout.php';
					 </script>";
					 
				}		
				
			}
		 ?>
		 <?php 
		 	if(isset($_POST['submit_timkiem'])){
				$input_timkiem = $_POST['input_timkiem'];
				$result_tksp = Total_TimkiemSanPham($con, $input_timkiem);
				$row_tksp = mysqli_fetch_assoc($result_tksp);
				$total_records_tksp = $row_tksp['total'];
				echo $total_records_tksp;
				if($input_timkiem != ''){
					
					if($total_records_tksp != 0){
						echo "<script>  	
					 		window.location.href = 'layout_timkiem.php?name=$input_timkiem';
					 	</script>";
					 	
					}
					else{
						echo "<script>  	
					 	window.location.href = 'layout.php';
					 </script>";
					 
					}

					
				}	
				else{
					echo "<script>  	
					 	window.location.href = 'layout.php';
					 </script>";
					 
				}
			}
		  ?>
	<?php include_once('../include/footer.php') ?>
	
</body>
</html>