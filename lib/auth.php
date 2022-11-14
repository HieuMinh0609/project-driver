<?php 
require 'conf.php';

function doLogin($conn,$username, $password){
	if(isValid($conn,$username, $password)==1) {
		$username_cookie =$username;
		$password_cookie =$password;


		startSession();

		$isMember = isMember($conn,$username, $password);
		$_SESSION["username"] = $username;

		startSession();
		$_SESSION["idrole"] =$isMember['idrole'] ;

		 if(!isset($_COOKIE['username']) && !isset($_COOKIE['password'])){
		 	setcookie("username", $username_cookie, time() + (86400 * 30), "/");
			setcookie("password", $password_cookie, time() + (86400 * 30), "/");
		 }
		return true;
	}	
	return false;
}

function checkLoggedInWeb() {
	startSession();
	// if(!isset($_SESSION["username"])) {
	// 	redirect("../../login/login.php");
	// }
}


function checkLoggedInAdmin() {
	startSession();
	 if(!isset($_SESSION["username"]) && ($_SESSION["idrole"])!='2') {
	 	redirect("../../login/login.php");
	 }
}


function isValid($conn,$username, $password) {
		$sql = "SELECT * FROM member where namelogin='$username' and password='$password' ";
		$restult =  db_query($conn,$sql);

		return mysqli_num_rows($restult);
}


function isMember($conn,$username, $password) {
		$sql = "SELECT * FROM member where namelogin='$username' and password='$password' ";



		$result=  db_query($conn,$sql);

		$row = mysqli_fetch_assoc($result);

		 return $row;
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
	if(isset($_SESSION["username"]) ){
		return $_SESSION["username"];
	}
	return null;
	
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

	redirect("../../login/login.php");
}

?>