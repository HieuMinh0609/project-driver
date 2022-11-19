<?php
 

function getAllMember($conn) {
	return db_query($conn, "SELECT * FROM bill");
}

function findPropertyMember($conn,$mapArray,$offset="",$limit="") {

    $sql = "select * from `user` where 1=1 ";
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


function createUser($conn, $username, $password,$status,$email,$address ,$phone,$gender, $full_name, $created_date, $role) {
	db_query_user($conn, "INSERT INTO `user`(`username`, `password`,`status`, `email`,`address`, `phone`,`gender`, `full_name`, `created_date`, `role`) 
	VALUES ('$username', '$password', '$status', '$email', '$address' , '$phone', '$gender', '$full_name', '$created_date', '$role')");
}



function db_query_user($conn, $query) {
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


function updateMember($conn,$id, $namelogin, $fullname,$password,$idrole,$sex,$address,$phone,$status) {
	$sql =  "UPDATE `user` SET `username`='$namelogin',`full_name`='$fullname',`password`='$password',`role`='$idrole', `gender`='$sex',`address`='$address',`phone`='$phone', `status` = '$status'  WHERE id = $id";
 
	db_query_user($conn,$sql);	
}

function deleteMember($conn, $id) { 
	 	$result = mysqli_query($conn, "DELETE FROM `user` WHERE id = $id");
	 	return $result;
}

function updatePassword($conn,$password,$phone) {
	 db_query($conn, "UPDATE `member` SET password='$password'  WHERE phone = '$phone'");
} 


function isExist($conn,$username) {
	$sql = "SELECT count(*) FROM `user` where `username`= '$username' and status = '1' ";
	$restult =  db_query($conn,$sql);
	return mysqli_num_rows($restult);
}

function getSingleUser($conn, $id) {
	return db_single($conn, "SELECT * FROM `user` WHERE id = $id");
}

function getSingleUserByUser($conn, $username) {
	return db_single($conn, "SELECT * FROM `user` WHERE `username` = '$username' ");
}


function getSingleMember_forgotpass($conn, $phone,$namelogin) {
	$result =  db_query($conn, "SELECT * FROM `member` WHERE phone ='$phone' and namelogin='$namelogin'");
	return mysqli_num_rows($result);
}

function newsCountOfMember($conn, $id) {
	$result = db_query($conn, "SELECT id  FROM `news` WHERE cat_id=$id
LIMIT 0,1");
	return mysqli_num_rows($result);
}


 
 ?>