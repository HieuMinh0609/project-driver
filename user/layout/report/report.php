<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Flowers.com</title>
	<link rel="stylesheet" href="../../bootstrap/css/style.css">
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../bootstrap/js/bootstrap.min.js">
	<script src="../../bootstrap/js/jquery-3.4.1.min.js"></script>
	 <script src="../../bootstrap/js/bootstrap.min.js"></script></head>
<body>
	
	<?php 

	include '../../lib/auth.php';

	if(isset($_POST["login"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {
			echo "tài khoản hoặc mật khẩu bạn không được để trống!";
		}
		else{
			doLogin($username,$password);
		}
		
	}

	?>
	<form action="" method="POST">
		<div class="form-dangnhap">
			<div class="form-dn-title">ĐĂNG NHẬP</div>
			<table class="taikhoan-matkhau">
				<tr>
					<td>Tài khoản:</td>
					<td>
						<input type="text" class="form-control" name="username">
					</td>
				</tr>
				<tr>
					<td>Mật khẩu:</td>
					<td>
						<input type="text" class="form-control" name="password">
					</td>
				</tr>
			</table>
			<button class="btn btn-primary button-dangnhap" name="login">Đăng nhập</button>
		</div>
	</form>
</body>
</html>