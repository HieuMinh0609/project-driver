<?php
require_once 'db.php';

function getAllCat($conn) {
	return db_query($conn, "SELECT * FROM bill");
}

function findProperty($conn,$mapArray,$offset="",$limit="") {
    $sql = "Select  b.idbill,b.place , m.fullname as nameMember,m.phone as phone,b.createdate,b.status,b.sell from bill b".   "  INNER JOIN member m  ON b.idmember = m.idmember where 1=1 ";
    if(count($mapArray)>0){
    	foreach ($mapArray as $key => $value){

    		$sql .=	 " AND " . $key  ." LIKE '%" .  $value ."%' " ;
    	}
          
     } 

     $sql .="Order by "." b.status desc";
 	if($offset!=="" ){
 		$sql .= " limit  " .$offset .",". $limit;
 	} 
	return db_query($conn,$sql);
}

function CountTypeChart($conn,$typeid,$month,$year){
	$sql ="select sum(SoLuong) as count from  bill_detail db inner join product p on p.idproduct = db.idProduct inner join bill b on db.idbill=b.idbill
		where p.typeid =$typeid And month(b.createdate) = $month and year(b.createdate)  =$year And b.status=0";


	$resultCountTypeChart=db_query($conn,$sql);

	return mysqli_fetch_assoc($resultCountTypeChart)['count'];
}

function CountTypeChartInYear($conn,$typeid,$year){
	$sql ="select sum(SoLuong) as count from  bill_detail db inner join product p on p.idproduct = db.idProduct inner join bill b on db.idbill=b.idbill
		where p.typeid =$typeid And year(b.createdate)  =$year And b.status=0";


	$resultCountTypeChart=db_query($conn,$sql);

	return mysqli_fetch_assoc($resultCountTypeChart)['count'];
}

function checkNull3($h1,$h2,$h3){
	  if($h1==""){
   		 $h1=0;
	 	 }
	  if($h2== ""){
	    $h2=0;
	  	}
	  if($h3==""){
	    $h3=0;
	  }
}


function CountTypeMoneyOf3Year($conn,$month,$year){
	$sql ="select sum(sell) as sell from  bill b
		where month(b.createdate) = $month and year(b.createdate)  =$year And b.status=0";


	$resultCountTypeChart=db_query($conn,$sql);

	return mysqli_fetch_assoc($resultCountTypeChart)['sell'];
}

function createBill($conn, $title, $description) {
	db_query($conn, "INSERT INTO `bill`(`title`, `description`) VALUES ('$title', '$description')");
}

function updateBill($conn, $id, $status) {
	 
	 db_query($conn, "UPDATE `bill` SET `status`='$status'  WHERE idbill = $id");
}

function deleteBill($conn, $id) { 
	 	$result = mysqli_query($conn, "DELETE FROM bill WHERE idbill = $id");
	 	return $result;
}

function db_query_bill($conn, $query) {
	if(!$result) {
		die("Error execute query: " . mysqli_error($conn));
	}
	return $result;
}

function getBill($conn, $id) {
	return db_single($conn, "SELECT * FROM bill WHERE idbill = $id");
}

function newsCountOfCat($conn, $id) {
	$result = db_query($conn, "SELECT id  FROM `news` WHERE cat_id=$id
LIMIT 0,1");
	return mysqli_num_rows($result);
}


 ?>