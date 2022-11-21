
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Driver</title>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../template/client.css"></link>
</head>
<body>
	
<?php 
	include_once ('../../../lib/auth.php');

	checkLoggedInWeb();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}
	
 ?>
<?php 
    require('../../../lib/db.php');
    require ('../../../lib/controls.php');
    require ('../../../lib/service/share_service.php');
    require ('../../../lib/service/share_permission_service.php');
    require ('../../../lib/service/store_file_folder_service.php');
  
?>

<?php 

// đoạn code này có tác dụng kiểm tra url chia sẻ nếu đúng sẽ add user vào bằng share_permission => user có quyền truy cập folder hoặc xem file
    
    $url_share = $_GET['url_share'] ?? null;
 
    startSession();
    if (!empty($url_share)) {
        $conn = db_connect();   
            $item = findShareByUrlShare($conn, "http://localhost/project-driver/client/layout/storeFileFolder/fileSearchArea.php?url_share=".$url_share);
            echo $item;
            if (!empty($item)) {

                $user_id = $_SESSION["id"];
                createSharePermission($conn, $item['id'], $user_id ); //  add user vào bằng share_permission =
                $file_or_folder = findById($conn, $item['id_store_file_folder']);
                echo $file_or_folder;
                if ($file_or_folder['type_store'] == 'FOLDER') { // kiểm tra xem nếu file chia sẻ là FOLDER thì điều hướng về trang hiển thị thư mục 
                    // nếu là FILE thì sẽ hiển thị file
                    redirect("./shareWithMe.php?parent_id=".$file_or_folder['id']);
                } else {
                    redirect("./showFile.php?id=".$file_or_folder['id']);
                }
            }
        db_close($conn);
    }

    if(isset($_POST["UPDATES"])){

          $conn = db_connect();
            update($conn,$idmember, 
                escapePostParam($conn, "parent_id"), 
                escapePostParam($conn,"id"));     
            db_close($conn);
        echo("<br><br><div class=\"container\">
            <div class=\"alert alert-success\">
            <strong>Success!</strong> Update status done!.
            </div></div>");
    
    }
  
?>