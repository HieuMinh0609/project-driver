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

	<div class="center">
		
		<?php include_once('../include/banner.php') ?>
		<div class="center-bottom"><br><br>
			<?php include_once('../product/douong_product.php') ?>
			<br>
			<?php include_once('../product/doan_fast_product.php') ?>
			<br>
			<?php include_once('../product/doan_hot_product.php') ?>
			
			
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

		
		
	</div>
	<?php include_once('../include/footer.php') ?>
</body>
</html>