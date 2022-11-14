<?php
require_once 'db.php';

 

function getAllFeedback($conn) {
	return db_query($conn, "SELECT * FROM feedback");
}

function findPropertyFeedback($conn,$mapArray,$offset="",$limit="") {
    $sql = "SELECT f.idfeedback,f.createdate,m.namelogin,f.content,f.status FROM feedback f inner join member m on  f.idmember = m.idmember Where 1=1 ";
    if(count($mapArray)>0){
    	foreach ($mapArray as $key => $value){

    		$sql .=	 " AND " . $key  ." LIKE '%" .  $value ."%' " ;
    	}
          
     } 

    $sql .="Order by "." f.status desc";

 	if($offset!=="" ){
 		$sql .= " limit  " .$offset .",". $limit;
 	}



 	 
	return db_query($conn,$sql);
}


function createFeedback($conn, $idproduct ,$percent) {
	db_query_Sale($conn, "INSERT INTO `feedback`(`idproduct`, `percent`) VALUES ('$idproduct','$percent')");


}



function db_query_Feedback($conn, $query) {
	$result1 = mysqli_query($conn, $query);
	if(!$result1) {
		  echo ("<br><div class=\"alert alert-danger alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Wrong!</strong> System have happen.
        </div>");
        
	}else{
		 echo ("<br><div class=\"alert alert-success alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Success!</strong>  You have successfully implemented.
        </div>");
	}
	return $result1;
}


function updateFeedback($conn) {
	 db_query($conn, "SET SQL_SAFE_UPDATES=0");
	 db_query_Feedback($conn, "UPDATE `feedback` SET `status`=0 where status=1");
	 db_query($conn, "SET SQL_SAFE_UPDATES=1;");
}

function countNewFeedBack($conn) {
	 
	$result= db_query($conn, "SELECT count(*) as count FROM feedback where status=1");

	   return  mysqli_fetch_assoc($result)['count'];
}
?>

