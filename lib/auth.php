<?php 
require 'conf.php';

function doLogin($conn,$username, $password) {
	if(isValid($conn,$username, $password)==1) {
		$username_cookie =$username;
		$password_cookie =$password;


		startSession();

		$isMember = isMember($conn,$username, $password);
		$_SESSION["username"] = $username;

		startSession();
		$_SESSION["role"] = $isMember['role'] ;
		$_SESSION["id"] = $isMember['id'] ;

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
	if(!isset($_SESSION["username"])) {
		redirect("../../login/login.php");
	}
}


function checkLoggedInAdmin() {
	startSession();
	 if(!isset($_SESSION["username"]) && ($_SESSION["role"])!='ADMIN') {
	 	redirect("../../login/login.php");
	 }
}


function isValid($conn,$username, $password) {
		 $sql = "SELECT count(id) as id FROM `user` where username='$username' and password='$password' and status = '1' ";
	 
		$result = mysqli_query($conn, $sql);
		$count = mysqli_fetch_assoc($result)['id'];

		if ($count == 0) return false;
		else return true;
	}


function isMember($conn,$username, $password) {
		$sql = "SELECT * FROM `user` where username='$username' and password='$password' and status = '1' ";
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