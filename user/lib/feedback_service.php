<?php 
require_once 'db.php';

function SaveFeedBack($conn,$createdate,$content,$idmember,$status){
	 
	return db_query($conn,"INSERT INTO feedback (`createdate`,`content`,`idmember`,`status`) VALUES ('$createdate','$content','$idmember','$status')");
}



?>