<?php
require_once 'db.php';

 

function getAllSale($conn) {
	return db_query($conn, "SELECT * FROM sale");
}

function findPropertySale($conn,$mapArray,$offset="",$limit="") {
    $sql = "SELECT s.idsale,s.idproduct , p.name ,s.percent FROM sale s inner join product p on s.idproduct = p.idproduct Where 1=1 ";
    if(count($mapArray)>0){
    	foreach ($mapArray as $key => $value){

    		$sql .=	 " AND " . $key  ." LIKE '%" .  $value ."%' " ;
    	}
          
     } 

    
 	if($offset!=="" ){
 		$sql .= " limit  " .$offset .",". $limit;
 	}
	return db_query($conn,$sql);
}


function createSale($conn, $idproduct ,$percent) {
	db_query_Sale($conn, "INSERT INTO `sale`(`idproduct`, `percent`) VALUES ('$idproduct','$percent')");


}



function db_query_Sale($conn, $query) {
	$result1 = mysqli_query($conn, $query);
	if(!$result1) {
		  echo ("<br><div class=\"alert alert-danger alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Wrong!</strong> Check input again id Product could duplicate.
        </div>");
        
	}else{
		 echo ("<br><div class=\"alert alert-success alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Success!</strong>  You have successfully implemented.
        </div>");
	}
	return $result1;
}


function updateSale($conn,$id, $idproduct, $percent ) {
	
	 db_query_Sale($conn, "UPDATE `sale` SET `idproduct`='$idproduct',`percent`='$percent'  WHERE idsale = $id");

	
}

function deleteSale($conn, $id) { 
	 	$result = mysqli_query($conn, "DELETE FROM sale WHERE idsale = $id");
	 	return $result;
}

function getIdProduct($conn){
	return mysqli_query($conn, "SELECT idproduct FROM sale ");
}

function getSingleSale($conn, $id) {
	return db_single($conn, "SELECT s.idsale,s.idproduct , p.name,p.image ,s.percent FROM sale s inner join product p on s.idproduct = p.idproduct Where  idsale= $id");
}



function newsCountOfSale($conn, $id) {
	$result = db_query($conn, "SELECT id  FROM `news` WHERE cat_id=$id
LIMIT 0,1");
	return mysqli_num_rows($result);
}
 

 ?>