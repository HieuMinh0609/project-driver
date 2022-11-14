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
	<style>
		.sua{
			border: 1px solid blue;
		    padding: 1px 10px 3px 10px;
		    background-color: blue;
		    color: white;
		    border-radius: 5px;
		}
		.xoa{

			border: 1px solid red;
		    padding: 1px 10px 3px 10px;
		    background-color: red;
		    color: white;
		    border-radius: 5px;
		
		}
	</style>
</head>
<body>
	<?php 
		include_once('../include/header.php') ;
	?>
<form  method="POST">
	<div class="row">
		<div class="danhsachcart col-md-8">
			
			<table class="table  table-responsive">
				<tr class="cart-title">
					<th></th>
					<th class="hinhanh">Hình ảnh</th>
					<th class="tensanpham">Tên sản phẩm</th>
					<th class="gia">Giá bán</th>
					<th class="soluong">Số lượng</th>
					<th class="thanhtien">Thành tiền</th>
					<th class="xoa-sua"></th>
				</tr>
				<div class="cart-content">
	
					
							<?php 
								include_once ('../../lib/db.php');
								include_once ('../../lib/controls.php');
								include_once ('../../lib/cart_service.php');
								include_once ('../../lib/auth.php');
								$tongtien1=0;
								$con =db_connect();
								$id_user = getIdUser(getLoggedInUser());
								
								$result = getAllCart($con,$id_user);
								$count  = mysqli_num_rows(getCount_IdUser($con, $id_user));
								if($count==0){
									redirect('../../layout/layout/layout.php');	
								}

							?>
							<?php while ($dong = mysqli_fetch_array($result)) {
							?>	
							<tr>
								<?php $id_product = $dong['idproduct'] ?>
								<td class="checkbox">
									<input id="<?php echo $id_product ?>" type="checkbox" name="abc[]" value="<?php echo $id_product ?>">
									
								</td>
								<td class="hinhanh">
									<img src="../../image/<?php echo $dong['anh']; ?>" alt="">
								</td>
								
								<td class="tensanpham"><?php echo $dong['tensanpham']; ?></td>
								<td class="gia"><?php echo number_format($promotion=$dong['giaban']*(100-$dong['giakm'])/100) ; ?> đ</td>
								<td class="soluong">
									<?php $amount= $dong['soluong']; ?>
									<input  type="text" style="width: 100px;" class="form-control input-number" value="<?php echo $amount; ?>" name="<?php echo $id_product; ?> " disabled>
									
								</td>
								<td class="thanhtien"><?php $sell = $dong['thanhtien'];
								echo number_format($sell); ?> đ</td>
								<td class="xoa-sua">
									<a class="sua" href="cart-edit.php?action=sua&id=<?php echo $id_product?>&promotion=<?php echo $promotion?>">Sửa</a>
									<a href="cart.php?action=xoa&id=<?php echo $id_product?>" class="xoa">Xoá</a>

								</td>
								
							</tr>

								
							
							
							

					

					<?php }		
									if(isset($_GET['action']) && $_GET['action']=="xoa"){
										$id_product=intval($_GET['id']);
										deleteCart($con, $id_user, $id_product);
										echo "<script> 
											window.location.href = 'cart.php';
										</script>";
									
										echo "<script> 							 	
											 	location.reload();
											 </script>";		
									
									}

									$result_tongtien = get_TongTien($con, $id_user);
									while ($dong_tongtien = mysqli_fetch_array($result_tongtien)) {
										$tongtien = $dong_tongtien['tongtien'];
									}
					 				if(isset($_POST["submit"])){
										
										if(isset($_POST["abc"])){
											$mangid = $_POST["abc"];
											
											foreach ($mangid as $key => $value) {
												echo "<script>
													document.getElementById('$value').checked=true;
												</script>";
												$result_thanhtien= getCart_ProductId($con, $id_user, $value);
												while ($dong_thanhtien = mysqli_fetch_array($result_thanhtien)) {
													$tongtien1 += $dong_thanhtien['thanhtien'];
												}


											}
											
										}
										
										
									}
									
								

								
								
							?>
							
					
					
				</div>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>Tổng tiền</td>
					<td><?php echo number_format($tongtien) ?> đ</td>
					<td><input type="submit" name="submit" value="Đặt Hàng" class="btn btn-primary">	</td>
				</tr>

				
			</table>
			
			
			
			
			
		</div>
		
		<div class="dathang col-md-4 ">
			<div class="dathang-muatiep"> 		
				<!-- <a href="layout.php" class="muatiep">mua tiếp</a>
				<a href="cart.php" class="dathang">Đặt hàng</a> -->
				<br>
					
				<input type="submit" name="muatiep" value="Mua Tiếp" class="btn btn-danger">	
				<hr>
				<span>Địa chỉ giao hàng</span>
				<textarea class="form-control" name="place" id="" cols="20" rows="2"></textarea>
				<hr>
				<span>Thông tin giỏ hàng</span>
				<br>
				<span>Tổng tiền: </span>  <span><?php echo number_format($tongtien1); ?> đ</span>
				<br>
				<br>
				<!-- <input type="submit" value="Xác nhận đơn hàng" class="btn btn-primary" name="xacnhanmuahang"> -->
				<button class="btn btn-primary" name="xacnhanmuahang">Xác nhận</button>
				</div>

		</div>
		
		<?php 

			include "../../lib/bill-service.php";
			if(isset($_POST['muatiep'])){
				echo "<script>  	
					 	window.location.href = '../layout/layout.php';
					 </script>";
			}
			if(isset($_POST['xacnhanmuahang'])){
				if(isset($_POST["abc"])){
					$mangid = $_POST["abc"];
					$date = getdate();
					
					$id_bill =$id_user. $date['mday'].$date['mon'].$date['year'].$date['hours'].$date['minutes'].$date['seconds'];
					$place = $_POST['place'];
					
					echo "mã bill:". $id_bill;
					
					foreach ($mangid as $key => $value) {
						echo "<script>
							document.getElementById('$value').checked=true;
						</script>";
						$result_thanhtien= getCart_ProductId($con, $id_user, $value);
						while ($dong_thanhtien = mysqli_fetch_array($result_thanhtien)) {
							$tongtien1 += $dong_thanhtien['thanhtien'];
							$soluong11 = $dong_thanhtien['soluong'];
						}
						

					}
					createBill($con,$id_bill,$place,$id_user,$tongtien1);

					foreach ($mangid as $key => $value) {
						echo "<script>
							document.getElementById('$value').checked=true;
						</script>";
						$result_thanhtien= getCart_ProductId($con, $id_user, $value);
						while ($dong_thanhtien = mysqli_fetch_array($result_thanhtien)) {
							$soluong11 = $dong_thanhtien['soluong'];
						}
						deleteCart($con, $id_user, $value);
						create_BillDetail($con, $id_bill, $soluong11, $value);

					}
					

					
					echo "<script>  	
					 	alert('Đơn hàng đang chờ phê duyệt.');
					 	window.location.href = 'cart.php';
					 </script>";
					
				}
			}
			db_close($con);
		 ?>
	</div>

	</form>
</body>
</html>