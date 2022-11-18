<?php
 
 

function createShare($conn, $id_store_file_folder, $url_share, $type_share, $password) {
	return db_query_share_return($conn, "INSERT INTO `share`(`id_store_file_folder`, `url_share`,`type_share`, `password`) 
	VALUES ('$id_store_file_folder', '$url_share', '$type_share', '$password')");
}

function db_query_share_return($conn, $query) {
	$result1 = mysqli_query($conn, $query);
	return mysqli_insert_id($conn);
}


function findShareByProperty($conn, $name_search, $user_id, $parent_id, $offset="", $limit="") {
 
	if(empty($parent_id)) {

		$sql = "SELECT sf.id, sf.name, sf.url, sf.type_store FROM `share` s 
		inner join `share_permission` sp on s.id = sp.share_id 
		inner join `store_file_folder` sf   on sf.id = s.id_store_file_folder
		where sp.user_id = '$user_id' ";
   
	} else {
		$sql = "SELECT sf.id, sf.name, sf.url, sf.type_store FROM `store_file_folder` sf  
		where  sf.parent_id = '$parent_id' ";
	}
	
	if(!empty($name_search)) {
		$sql .=	 " AND `name` LIKE '%" .  $name_search ."%' " ;      
	} 

    $sql .=' group by sf.id, sf.name, sf.url , sf.type_store';
	
 	if($offset!=="" ) {
 		$sql .= " limit  " .$offset .",". $limit;
 	} 
 
	return db_query($conn, $sql);
}


function findShareById($conn, $id) {
	 $data = db_single($conn, "SELECT * FROM `share` WHERE id_store_file_folder = $id");
 
	 return $data;
}

function deleteByIdFile($conn, $id) {
	$data = db_query($conn, "DELETE FROM `share` WHERE id_store_file_folder = $id");

	return $data;
}

function findShareByUrlShare($conn, $url) {
	
	$sql = "SELECT * FROM `share` WHERE `url_share` = '$url'";
	echo $sql ;
	return db_single($conn, $sql);
}


function isCorrectPasswordShare($conn, $id, $password) {
	return db_single($conn, "SELECT * FROM `share` WHERE id_store_file_folder = $id AND `password` = '$password' ");
}

function db_query_share($conn, $query) {
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

 
 ?>