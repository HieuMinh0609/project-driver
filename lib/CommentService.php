<?php 
	function deleteComment($conn, $id) { 
	 	$result = mysqli_query($conn, "DELETE FROM comment WHERE idcomment = '$id'");
	 	return $result;
}



?>