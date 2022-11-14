<?php
require_once 'db.php';

function getAllDeatailBill($conn,$id) {

 
	return db_query($conn, "Select  b.idbill_detail,b.idbill,b.idproduct ,b.SoLuong,p.name,p.image from bill_detail  b   INNER JOIN product p  ON b.idproduct = p.idproduct  
 INNER JOIN bill bi  ON b.idbill = bi.idbill  
where b.idbill ='".$id."'");

	
}

function getTotalSellBill($conn,$id){
	$result= db_query($conn, "Select sum((p.sell*b.SoLuong)) as 'total' from bill_detail  b   INNER JOIN product p  ON b.idproduct = p.idproduct  
 INNER JOIN bill bi  ON b.idbill = bi.idbill  
where b.idbill='".$id."'");
	 

	return mysqli_fetch_assoc($result)['total'];
}

function updateSellBill($conn,$id,$sell){
	return db_query($conn, "Update bill set  sell=".$sell."  WHERE idbill ='".$id."'");
}

function getForPdf($conn,$id) {

 
	return db_query($conn, "Select b.idbill ,b.SoLuong,p.name,(p.sell*b.SoLuong) as sell from bill_detail  b   INNER JOIN product p  ON b.idproduct = p.idproduct  
 INNER JOIN bill bi  ON b.idbill = bi.idbill  
where b.idbill='".$id."'");

}
function createDetailBill($conn, $title, $description) {
	db_query($conn, "INSERT INTO `bill`(`title`, `description`) VALUES ('$title', '$description')");
}

function updateDeatailBill($conn, $id, $count) {
	 

	 db_query($conn, "UPDATE `bill_detail` SET SoLuong=$count  WHERE idbill_detail = $id");
	 
		 
}

function deleteBillDeail($conn, $id) { 
	 	db_query($conn, "DELETE FROM `bill_detail` WHERE idbill_detail = $id");
	 	 
}

function db_query_detailbill($conn, $query) {
	$result = mysqli_query($conn, $query);
	if(!$result) {
		die("Error execute query: " . mysqli_error($conn));
	}
	return $result;
}

function getDetailBill($conn, $id) {
	return db_single($conn, "Select  b.idbill_detail,b.idbill ,b.SoLuong,p.name,p.image from bill_detail  b   INNER JOIN product p  ON b.idproduct = p.idproduct  
 INNER JOIN bill bi  ON b.idbill = bi.idbill  
where b.idbill_detail ='".$id."'");
}
 ?>