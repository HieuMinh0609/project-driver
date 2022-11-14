<?php 

	require_once 'db.php';
	function createBill($conn,$id_bill, $place, $id_user, $sell){
		return db_query($conn,"INSERT INTO bill VALUES ($id_bill,'$place',$id_user,now(),1,$sell)");
	}
	function create_BillDetail($conn,$id_bill, $soluong, $id_product){
		return db_query($conn,"INSERT INTO `bill_detail`( `idbill`, `SoLuong`, `idproduct`) VALUES ($id_bill,$soluong,$id_product)");
	}
	
 ?>