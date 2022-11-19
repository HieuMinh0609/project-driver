<?php
 

function getAllSystemConfig($conn) {
	return db_query($conn, "SELECT * FROM `config_system`");
}

function getSingleSystemConfig($conn, $id) {
 
	return db_single($conn, "SELECT * FROM `config_system` WHERE `id` = $id" );
}
 

function createSystemConfig($conn, $code, $name ,$value) {
	db_query_config($conn, "INSERT INTO `config_system`(`code`, `name`,`value`) 
	VALUES ('$code', '$name', '$value')");
}
 
function db_query_config($conn, $query) {
	$result1 = mysqli_query($conn, $query);
	if(!$result1) {
		  echo ("<br><div class=\"alert alert-danger alert-dismissible \">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Lỗi!</strong> Có lỗi sảy ra
        </div>");
        
	} else {
		 echo ("<br><div class=\"alert alert-success alert-dismissible \">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Thành công!</strong>  Bạn đã thực hiện thành công !
        </div>");
	}
	return $result1;
}


function updateSystemConfig($conn,$id, $code, $name ,$value) {
	$sql =  "UPDATE `config_system` SET `code`='$code',`name`='$name',`value`='$value' WHERE id = '$id' ";
 
	db_query_config($conn,$sql);	
}

function deleteSystemConfig($conn, $id) { 
	 	$result = mysqli_query($conn, "DELETE FROM `config_system` WHERE id = $id");
	 	return $result;
}
 