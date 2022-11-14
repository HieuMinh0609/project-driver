<?php 
require_once 'db.php';
function doLogin1($username, $password) {
	if(isValid($username, $password)!=0) {
		startSession();
		$_SESSION["username"] = $username;
		redirect("../layout/layout.php");	
	}	
	else{
		echo "sai tài khoản hoặc mật khẩu";
	}
}
function getIdUser($username){
	$con =db_connect();
	$check = db_query($con,"SELECT * FROM member where namelogin='$username'") ;
	while ($dong = mysqli_fetch_array($check)) { 
		$result = $dong['idmember'];
	}
	 
	return $result;
}

function isRoleUserAdmin($conn,$id){
	//$check = db_query($conn,"SELECT * FROM member where idmember='$id'");
	//
	$result=db_single($conn,"SELECT * FROM member where idmember='$id'");	 
		$isRole = $result['idrole'];

	if($isRole==2){ 
	return true;
	}else{
		return false;
	}
}

function checkLoggedIn() {
	startSession();
	// if(!isset($_SESSION["username"])) {
	// 	redirect("../../../login/login.php");
	// }
}

function isValid($username, $password) {
	$con =db_connect();
	$check = db_query($con, "SELECT * FROM member where namelogin='$username' and password='$password'");
	$num_rows = mysqli_num_rows($check);
	return $num_rows;
}

function startSession() {
	if(session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}

function redirect($page) {
	header("location:$page");
}

function getLoggedInUser(){ 
	startSession();
	if(isset($_SESSION["username"])){
		$username = $_SESSION["username"];
	}
	else{
		$username ="";
	}
	return $username;
}

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
	redirect("../../../login/login.php");
}

?>