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
	<?php 
		include_once "../include/header.php";
		include_once ('../../lib/db.php');
		include_once ('../../lib/auth.php');
		include_once ('../../lib/controls.php');
		include_once ('../../lib/cart_service.php');
		include_once ('../../lib/comment_service.php');
		
		$con =db_connect();
		
	 ?>
	 <?php 
	 	if(isset($_GET['action']) && $_GET['action']=="detail"){
			$id_product=intval($_GET['id']);	
		}
		$result = GetProduct_Id($con,$id_product);
		
	  ?>
	  <?php while($dong = mysqli_fetch_array($result)){ ?>
	  <form action="" method="POST">
	 <div class="center-left row">
	 	<div class="col-md-8 row">
	 		<div class="col-md-6 image">
				<img src="../../image/<?php echo $dong['image'] ?>" alt="">
				<br>
				<br><br><br>
				
					<div class="danhgia row">
						<div class="col-md-2"></div>
						<span class="col-md-4">Đánh giá</span>
						<input type="number" class="form-control col-md-2" value="5" max="5" min="1" name="rate"> 
						
					</div>
				
	 		</div>
		 	<div class="col-md-6 product-info">
		 		
				<div class="product-name"><?php echo substr($dong['name'],0,80); ?></div>
				<hr>
				<span class="product-danhgia">Số sao: <?php echo round( $dong['avg_rate'], 1, PHP_ROUND_HALF_UP); ?></span>
				<div class="product-price-promotion">
					<?php 
						 $promotion=$dong['sell']*(100-$dong['promotion'])/100;
						echo number_format($promotion) ;
					 ?> đ

				</div>
				<div class="product-price"><?php echo number_format($dong['sell'])?> đ</div>
				<div class="product-mota"><?php echo substr($dong['information'],0,270); ?></div>
				
				<button class="btn btn-primary themgiohang" name="themvaogiohang">Thêm vào giỏ hàng</button>
				<button class="btn btn-danger muatiep" name="muatiep">Mua tiếp</button>
				<hr>
				<div class="binhluan col-md-8">
 				<span >Bình luận</span>
 				<textarea class="form-control" name="textbinhluan" id="" cols="20" rows="3"></textarea>
 				<button class="btn btn-primary" name="binhluan">Bình luận</button>
 			</div>
 			<hr>
		 	</div>

	 		<?php } ?>

	 	</div>

	 	<div class="col-md-4 comment">
			
	 		<div class="danhsachbinhluan">
	 			<h3>Danh sách bình luận</h3>
	 			<hr>
	 			<?php 
					$result1 = TotalComment_Id($con, $id_product);
					
					$row = mysqli_fetch_assoc($result1);
					$total_records = $row['total'];
					

					$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
					if($current_page ==0){
						$current_page =1;
					}
					$limit = 5;

					$total_page = ceil($total_records / $limit);

					
					if ($current_page > $total_page){
					    $current_page = $total_page;
					}
					else if ($current_page < 1){
					    $current_page = 1;
					}

					$start = ($current_page - 1) * $limit;
					if($start <0){
						$start =0;
					}
					
					$result1 = getComment_IdProduct($con,$id_product,$start,$limit);
					
	 				while ($dong1 = mysqli_fetch_array($result1)) {
	 					 
						?>
						
			 			<span><?php echo $dong1['namelogin'] ?></span>
			 			<?php 

			 			if(isset($_SESSION["username"])){
			 				
			 				$id=getIdUser($_SESSION["username"]);
			 				
			 				if(isRoleUserAdmin($con,$id)){
			 					
			 					echo '<button onclick="deletecomment(this)" class="btn btn-danger" title="delete" style="
    							padding: 0px 2px 0px 2px;" idcomment="'.$dong1['idcomment'].'">delete</button>';

    							 
    							
			 				}
			 			}
			 			 ?>
			 			<br>
					 	<p><?php echo $dong1['content']; ?></p>
					 		 	
					 		 	

				 		<hr>
				 		
					   <?php 
					  
							}
					   ?>
			    	<div class="pagination-detail">
			    	<?php  
				    if ($current_page > 1 && $total_page > 1){
				        echo '<a href="product-detail.php?action=detail&id='.($id_product).'&page='.($current_page-1).'">Prev</a> ';
				    }

				    
				    for ($i = 1; $i <= $total_page; $i++){
				        
				       
				            echo '<a class="trang" href="product-detail.php?action=detail&id='.($id_product).'&page='.$i.'">'.$i.'</a> ';
				        
				    }

				    
				    if ($current_page < $total_page && $total_page > 1){
				        echo '<a href="product-detail.php?action=detail&id='.($id_product).'&page='.($current_page+1).'">Next</a> ';
				    }
				
					?>
				</div>
		 	</div>
	 	</div>
	 </div>
	</form>
	<?php 
		
		
		if(isset($_POST['binhluan'])){
			if(getLoggedInUser() != ''){
				$id_user = getIdUser(getLoggedInUser());
				$content = $_POST['textbinhluan'];

				$rate = $_POST['rate'];
				
				
				CreateComment($con, $content, $id_product, $rate, $id_user);
				echo '<script> 
					window.location.href="product-detail.php?action=detail&id='.($id_product).'&page='.(1).'";
				</script>';
			}
			else{
				 echo "<script> 
					 	window.location.href = '../../../login/login.php';
				 </script>";
			}
			
		
			
		}
		if(isset($_POST['themvaogiohang'])){
			if(isset($_GET['action']) && $_GET['action']=="detail"){
				$id_product=intval($_GET['id']);	
			}
			if(getLoggedInUser() !=''){
				$id_user = getIdUser(getLoggedInUser());

				
				if(checkCart($con, $id_user, $id_product)==0){
					
					createCart($con,$id_user,$id_product,$promotion);
					
				}
				else{
					
					$row = getAmount($con, $id_user, $id_product);
					while ($dong = mysqli_fetch_array($row)) {
						$amount = $dong['amount'];
					}
					
					$amount = $amount +1;
					$sell =$promotion * $amount;
					echo $amount;
					echo $promotion;
					echo $sell;
					updateCart($con, $id_user, $id_product, $amount,$sell);	
					
				}
				echo '<script>  	
				 	window.location.href = "product-detail.php?action=detail&id='.($id_product).'&page='.(1).'";
				 </script>';	
				 echo "
					<script>  	
				 		location.reload();
				 	</script>";		
			
			}
			else {
				 echo "<script> 
				 	window.location.href = '../../../login/login.php';
				 								 </script>";
			}
			

		}
		if(isset($_POST['muatiep'])){
			 echo "<script> 
				 	window.location.href = '../layout/layout.php';
				 								 </script>";
		}
		
	 ?>
	 
<script type="text/javascript">
	
	function deletecomment(argument) {

		var confirmText = "Are you sure you want to delete this comment?";
		if(confirm(confirmText)) {
		$idComment=$(argument).attr('idcomment');
		 

         $.ajax({
        url : '../../../admin/ajax/DeleteComment.php',
        type : 'post',
        dataType : 'json',
        data : {
            id :  $idComment
             
        },
        success : function (data)
        {
              alert("Delete success!");            
		},
		error :function(data)
		{
			alert("Delete Fail!"); 
		}
           
        
       
	});
}
}
</script>
	 
</body>
</html>