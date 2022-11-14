<?php 
	require_once 'db.php';
	function getComment_IdProduct($conn, $id_product, $start,$limit){
		return db_query($conn, "SELECT content, namelogin,idcomment  FROM comment,member where idproduct ='$id_product' and comment.idmember = member.idmember order by idcomment DESC LIMIT $start,$limit");
	}
	function TotalComment_Id($conn, $id_product){
		return db_query($conn, "SELECT count(idcomment) as 'total' FROM comment where idproduct ='$id_product' order by idcomment DESC ");
	}
	function CreateComment($conn, $content, $id_product, $rate, $id_user){
		return db_query($conn, "INSERT INTO `comment` (`idcomment`, `content`, `datecomment`, `idproduct`, `rate`, `idmember`) VALUES (NULL, '$content', now(), $id_product, $rate, $id_user)");
	}
 ?>