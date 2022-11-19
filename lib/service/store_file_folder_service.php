<?php
 

 
function countFolderOrFileByProperty($conn,$name_search, $file_or_folder) {
	$user_id = $_SESSION["id"];
    $sql = "select count(*) as total from `store_file_folder` where  `id_user` = $user_id ";

    if(!empty($name_search)) {
    		$sql .=	 " AND `name` LIKE '%" .  $name_search ."%' " ;      
    } 

	$sql .=	" AND `type_store` = '$file_or_folder' ";

	return db_query($conn, $sql);
}

function findFolderOrFileByPropertyForAdmin($conn, $name_search, $offset="", $limit="") {

    $sql = "select sf.*, u.username from `store_file_folder` sf inner join `user` u on sf.id_user = u.id where 1=1 ";
	
	if(!empty($name_search)) {
		$sql .=	 " AND sf.`name` LIKE '%" .  $name_search ."%' " ;      
	} 

 	if($offset!=="" ){
 		$sql .= " limit  " .$offset .",". $limit;
 	}
 
	return db_query($conn, $sql);
}


function findFolderOrFileByProperty($conn, $name_search, $parent_id, $file_or_folder, $offset="", $limit="") {

	$user_id = $_SESSION["id"];

    $sql = "select * from `store_file_folder` where `id_user` = $user_id ";
	
	if(!empty($parent_id) ) {
		$sql .=	 " AND parent_id = '$parent_id' " ;    
	} else {
		$sql .=	 " AND parent_id is null  " ;   
	}

	if(!empty($name_search)) {
		$sql .=	 " AND `name` LIKE '%" .  $name_search ."%' " ;      
	} 

    $sql .=	" AND `type_store` = '$file_or_folder' ";

 	if($offset!=="" ){
 		$sql .= " limit  " .$offset .",". $limit;
 	}
 

	return db_query($conn, $sql);
}

function deleteById($conn, $id) {
	$result = mysqli_query($conn, "DELETE FROM `store_file_folder` WHERE id = $id");
	return $result;
}

function findById($conn, $id) {
	return db_single($conn, "SELECT * FROM `store_file_folder` WHERE id = $id");
}

function update($conn, $parent_id, $id, $name) {
	if(!empty($parent_id)) {
		db_query_file_or_folder($conn, "UPDATE `store_file_folder` SET  `parent_id` = $parent_id , `name` = $name  WHERE `id` = '$id'");
	} else {
		db_query_file_or_folder($conn, "UPDATE `store_file_folder` SET  `parent_id` = null , `name` = $name  WHERE `id` = '$id'");
	}
}

function save($conn, $parent_id, $name, $type_file, $user_id, $url) {
	if(!empty($parent_id)) {
		db_query_file_or_folder($conn, "INSERT INTO `store_file_folder` (`name`, `id_user`, `parent_id`, `url`, `type_store`) 
		VALUES ('$name', '$user_id',  $parent_id , '$url', '$type_file' )");
	} else {
		db_query_file_or_folder($conn, "INSERT INTO `store_file_folder` (`name`, `id_user`, `url`, `type_store`) 
		VALUES ('$name', '$user_id', '$url', '$type_file' )");
	}
	
}

function saveFolder($conn, $parent_id, $name, $type_file, $user_id) {
	if(!empty($parent_id)) {
		db_query_file_or_folder($conn, "INSERT INTO `store_file_folder` (`name`, `id_user`, `parent_id`, `type_store`) 
		VALUES ('$name', '$user_id',  $parent_id, '$type_file' )");
	} else {
		db_query_file_or_folder($conn, "INSERT INTO `store_file_folder` (`name`, `id_user`, `type_store`) 
		VALUES ('$name', '$user_id', '$type_file' )");
	}
	
}

function db_query_file_or_folder($conn, $query) {

	$result1 = mysqli_query($conn, $query);

	if(!$result1) {
		  echo ("<br><div class=\"alert alert-danger alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Lỗi!</strong> Có lỗi sảy ra
        </div>");
        
	} else {
		 echo ("<br><div class=\"alert alert-success alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Thành công!</strong>  Bạn đã thực hiện thành công !
        </div>");
	}
	return $result1;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
 ?>
 
 