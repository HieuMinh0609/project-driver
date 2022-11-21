<?php 
require 'conf.php';


// Kiểm tra trạng thái đăng nhập
function doLogin($conn,$username, $password) {
	if(isValid($conn,$username, $password)==1) {
		$username_cookie =$username;
		$password_cookie =$password;


		//Khởi động session
		startSession();

		$isMember = isMember($conn,$username, $password); //kiểm tra xem tài khoản có tồn tại không
		$_SESSION["username"] = $username;  //gán username vào session

		startSession();
		$_SESSION["role"] = $isMember['role'] ; 
		$_SESSION["id"] = $isMember['id'] ;


		if(!isset($_COOKIE['username']) && !isset($_COOKIE['password'])){
		 	setcookie("username", $username_cookie, time() + (86400 * 30), "/"); // gán thời gian cho cookie
			setcookie("password", $password_cookie, time() + (86400 * 30), "/");
		}

		return true;
	}	
	
	return false;
}


//kiểm tra quyền truy cập web , nếu có  SESSION mới được truy cập tiếp còn không có sẽ được điều hướng về trang login
function checkLoggedInWeb() {
	startSession();
	if(!isset($_SESSION["username"])) {
		redirect("../../login/login.php");
	}
}


//kiểm tra quyền truy cập web , nếu có  SESSION mới được truy cập tiếp còn không có sẽ được điều hướng về trang login
function checkLoggedInAdmin() {
	startSession();
	 if(!isset($_SESSION["username"]) && ($_SESSION["role"])!='ADMIN') {
	 	redirect("../../login/login.php");
	 }
}

//kiểm tra user có tồn tại không
function isValid($conn,$username, $password) {
		 $sql = "SELECT count(id) as id FROM `user` where username='$username' and password='$password' and status = '1' ";
	 
		$result = mysqli_query($conn, $sql);
		$count = mysqli_fetch_assoc($result)['id'];

		if ($count == 0) return false;
		else return true;
	}


//Lấy thông tin của 1 khách hàng
function isMember($conn,$username, $password) {
		$sql = "SELECT * FROM `user` where username='$username' and password='$password' and status = '1' ";
		$result=  db_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
}


//Hàm start session trong php
function startSession() {
	if(session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}

//Hàm diều hướng trang
function redirect($page) {
	header("location:$page");
}



function getLoggedInUser(){ 
	startSession();
	if(isset($_SESSION["username"]) ){
		return $_SESSION["username"];
	}
	return null;
	
}

//Hàm đăng xuất và xóa thông tin username passord ra khỏi cookie
function doLogout() {
	startSession();
	session_destroy();

	$username_cookie = 'username';
	$password_cookie = 'password';
	unset($_COOKIE[$username_cookie]);
	// empty value and expiration one hour before
	  setcookie($username_cookie, "", time() - 3600,"/");
	unset($_COOKIE[$password_cookie]);
	  setcookie($password_cookie,"", time() - 3600,"/");

	redirect("../../login/login.php");
}

?>