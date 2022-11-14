<?php 
require 'conf.php';

function db_connect() {
	global $conf;
	$conn = mysqli_connect($conf["host"], $conf["user"], $conf["password"], $conf["db"]) or die("Cannot connect to db: " . mysqli_connect_error());
	mysqli_set_charset($conn, "utf8");

	return $conn;
}

function db_query($conn, $query) {
	$result = mysqli_query($conn, $query);
	if(!$result) {
		die("Error execute query: " . mysqli_error($conn));
	}

	return $result;
}

function db_single($conn, $query) {
	$result = db_query($conn, $query);
	
	$row = mysqli_fetch_assoc($result);

	return $row;
}

function db_close($conn) {
	mysqli_close($conn);
}

function escapePostParam($conn, $key) {
	return mysqli_real_escape_string($conn, $_POST[$key]);
}

function escapeGetParam($conn, $key) {
	return mysqli_real_escape_string($conn, $_GET[$key]);
}


?>