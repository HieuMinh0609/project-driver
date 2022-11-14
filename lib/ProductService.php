<?php
require_once 'db.php';

function getAllProduct($conn) {
	return db_query($conn, "SELECT * FROM product");
}

function getAllType($conn) {
	return db_query($conn, "SELECT * FROM type");
}

function findPropertyProduct($conn,$mapArray,$offset="",$limit="") {
    $sql = "SELECT   p.idproduct, p.name,p.sell,e.typename,p.status  FROM product p INNER JOIN type e on p.typeid = e.typeid where 1=1 ";
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


function createProduct($conn, $name, $information,$sell,$typeid,$image,$status) {
	db_query_Product($conn, "INSERT INTO `product`(`name`, `information`,`sell`, `typeid`,`image`, `status`) VALUES ('$name','$information','$sell','$typeid','$image','$status')");


}



function db_query_Product($conn, $query) {
	$result1 = mysqli_query($conn, $query);
	if(!$result1) {
		  echo ("<br><div class=\"alert alert-danger alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Wrong!</strong> Check input again nameproduct could duplicate.
        </div>");
        
	}else{
		 echo ("<br><div class=\"alert alert-success alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Success!</strong>  You have successfully implemented.
        </div>");
	}
	return $result1;
}


function updateProduct($conn,$id, $name, $information,$sell,$typeid,$image,$status) {
	 
	 

	 db_query_Product($conn, "UPDATE `product` SET `name`='$name',`information`='$information',`sell`='$sell',`typeid`='$typeid',`image`='$image',`status`='$status'   WHERE idproduct = $id");

	
}

function deleteProduct($conn, $id) { 
	 	$result = mysqli_query($conn, "DELETE FROM product WHERE idproduct = $id");
	 	return $result;
}

 

function getSingleProduct($conn, $id) {
	return db_single($conn, "SELECT * FROM `product` WHERE idproduct = $id");
}



function newsCountOfProduct($conn, $id) {
	$result = db_query($conn, "SELECT id  FROM `news` WHERE cat_id=$id
LIMIT 0,1");
	return mysqli_num_rows($result);
}

function uploadFileimage($target_file,$target_file2,$fileToUpload=""){
	

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["$fileToUpload"]["tmp_name"]);
    if($check !== false) {
       
        $uploadOk = 1;
    } else {
        
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
      
    $uploadOk = 0;
}
 
// Check file size
if ($_FILES["$fileToUpload"]["size"] > 500000) {
    
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
     
// if everything is ok, try to upload file
} else {
    if( move_uploaded_file($_FILES["$fileToUpload"]["tmp_name"], $target_file)){
        copy($target_file  , $target_file2);  
    }

    
 

}
}


 


 ?>