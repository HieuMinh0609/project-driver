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
		include_once('../include/header.php') ;
		include_once('../../lib/db.php') ;
		include_once('../../lib/auth.php') ;
		include_once('../../lib/cart_service.php') ;

		$con =db_connect();
		if(isset($_GET['id']) ){
			$id_product = $_GET['id'];
		}
		if(isset($_GET['promotion']) ){
			$promotion = $_GET['promotion'];
		}
		$id_user = getIdUser(getLoggedInUser());
		$result = getCart_ProductId($con,$id_user,$id_product);
		 while ($dong = mysqli_fetch_array($result)) { 
	 
	?>
	<form action="" method="POST">
	<div class="full">
		<table class="">
			<tr class="product-name">
				<td class="title">Tên sản phẩm</td>
				<td>
					<p><?php echo $dong['tensanpham']; ?></p>
				</td>
			</tr>
			
			<tr class="product-image">
				<td class="title">Hình ảnh</td>
				<td>
					<img src="../../image/<?php echo $dong['anh'] ?>" alt="">
				</td>			
			</tr>
			<hr>
			<tr class="product-price">
				<td class="title"><span>Giá</span></td>
				<td><span><?php echo $promotion; ?> đ</span></td>
			</tr>
			<tr class="amount">
				<td class="title"><span>Số lượng</span></td>
				<td class="row soluong">
					<div class="col-md-2"></div>
					<input type="number" min=1 value="<?php
						$amount = $dong['soluong'];
					 	echo  $amount;
					 ?>" name="amount" class="form-control col-md-3 soluong" >
					<div class="col-md-1"></div>
					<button class="btn btn-primary col-md-4 tinh" name="tinh" >Tính</button>
				</td>
				
			</tr>
			<tr class="sell">
				<td class="title"><span>Thành tiền</span></td>
				<td><input class="thanhtien" type="text" disabled="" style="width: 140px;" value="<?php echo $dong['thanhtien'] ?> đ"></td>
			</tr>
		</table>
	<?php } ?>
		<button class="btn btn-primary sua" name="sua">Sửa</button>
	</div>
	</form>

	
	<?php 
		
		if(isset($_POST["tinh"])) {
			$soluong = $_POST["amount"];
			$sell = $soluong * $promotion;	
				echo "<script>
					$('.soluong').val('$soluong');
					$('.thanhtien').val('$sell');
				</script>";
		}
		if(isset($_POST["sua"])){
			$soluong = $_POST["amount"];
			$sell = $soluong * $promotion;	
			updateCart($con, $id_user, $id_product, $soluong, $sell);
			echo "<script>  	
			 	window.location.href = 'cart.php';
			 </script>";
		}
		// updateCart($con, $id_user, $id_product, $amount, $sell);
		
	 ?>
</body>
</html>