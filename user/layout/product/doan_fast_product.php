
<div class="danhmuc">
	<span>Danh sách đồ ăn nhanh</span>
	<a href="../product/full-fastfood.php">Xem tất cả >>></a>
</div>
			<br>
			<hr>
			<div class="danhsach row">
				<?php 
					include_once ('../../lib/db.php');
					include_once ('../../lib/controls.php');
					include_once ('../../lib/cart_service.php');
					include_once ('../../lib/auth.php');
					
					$con =db_connect();
					$result = Product_Doan_Fast($con);

				?>
				<?php while ($dong = mysqli_fetch_array($result)) {
				?>	
				<div class="p1 col-md-3">
					<div class="product">
						
						
						<form action="" method="POST">						
							<a href="../product/product-detail.php?action=detail&id=<?php echo $id_product?>">
					<img src="../../image/<?php echo $dong['image']; ?>" alt=""></a><br>
				<?php $id_product= $dong['idproduct'];?>
				<a href="../product/product-detail.php?action=detail&id=<?php echo $id_product?>">
					<span class="product-name"><?php echo substr($dong['name'],0,40) ; ?></span></a><br>
							<span class="product-price-khuyenmai">
								<?php echo number_format($promotion=$dong['sell']*(100-$dong['promotion'])/100) ; ?> đ
							</span>
							<span class="product-price"><?php echo number_format($dong['sell']) ; ?> đ</span>	<br> <br>
							

						<a href="layout.php?action=add2&id=<?php echo $id_product?>&promotion=<?php echo $promotion ?>" class="themgiohang">Thêm vào giỏ hàng</a>

						</form>

					</div>
				</div>
				<?php } ;
					
					if(isset($_GET['action']) && $_GET['action']=="add2"){
						if(getLoggedInUser() !=''){
							$id_product=intval($_GET['id']);
							$promotion=intval($_GET['promotion']);
							
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
								echo $amount;
								echo $promotion;
								echo $sell;
								updateCart($con, $id_user, $id_product, $amount,$sell);	
							}
							echo "<script>  	
							 	window.location.href = 'layout.php';
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
			
			<hr>