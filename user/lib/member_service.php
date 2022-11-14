<?php 
	require_once 'db.php';
	function getIdUser1($conn,$username){

		 
		return db_query($conn,"SELECT idmember from member where namelogin='$username'");
	}
	
 ?>