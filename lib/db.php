<?php 
require 'conf.php';


// kết nối database
function db_connect() {
	global $conf;
 
	$conn = mysqli_connect($conf["host"], $conf["user"], $conf["password"], $conf["db"]) or die("Cannot connect to db: " . mysqli_connect_error());
	mysqli_set_charset($conn, "utf8");

	return $conn;
}

//  thực thi lệnh sql
function db_query($conn, $query) {
	$result = mysqli_query($conn, $query);
	if(!$result) {
		die("Error execute query: " . mysqli_error($conn));
	}

	return $result;
}


//  hàm lấy để ra 1 dòng dữ liệu 
function db_single($conn, $query) {
	$result = db_query($conn, $query);
	
	$row = mysqli_fetch_assoc($result);

	return $row;
}


// Đóng kết nối database
function db_close($conn) {
	mysqli_close($conn);
}


//Lấy param submit method post 
function escapePostParam($conn, $key) {
	if (!isset($_POST[$key])) return '';
	return mysqli_real_escape_string($conn, $_POST[$key]);
}


//Lấy param trên url hoặc submit bằng method get
function escapeGetParam($conn, $key) {
	if (!isset($_GET[$key])) return '';
	return mysqli_real_escape_string($conn, $_GET[$key]);
}


?>