
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

	include_once ('../../../lib/db.php');
 
	include_once ('../../../lib/auth.php');
	include_once ('../../../lib/service/share_service.php');
	include_once ('../../../lib/service/store_file_folder_service.php');


	
	checkLoggedInWeb();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}
	
 ?>

<?php 
	 startSession();

	 // kiểm tra xem bạn có quyền xem file này ko
	 // nếu có reutrn true , ko có return false
	 function isIdParentInCache($parent_id) {
	
			if (isset($_SESSION["permisstionFiles"])) {

				if(in_array( $parent_id , $_SESSION["permisstionFiles"]) ) {
					 return true;
				} else return false;

			} else return false;
	 }
	
 ?>

<?php

	 // bắt submit nhập mật khẩu đối với file yêu cầu nhập mật khẩu
	 if(isset($_POST["CONFIRM"])) {
	
	
	  $conn = db_connect();
	  		$parent_id = $_GET['parent_id'] ?? null;
	  		$password = escapePostParam($conn, "password"); // lấy value password từ form submit method post
			$item = isCorrectPasswordShare($conn, $parent_id, $password ); // kiểm tra xem mật khẩu nhập vào có đúng ko  ../../../lib/service/share_service.php
 
			if(empty($item)) {
					echo("<br><br><div class=\"container\">
					<div class=\"alert alert-warning\">
					<strong>Lỗi!</strong> Sai mật khẩu!.
					</div></div>");
			} else {

				if (!isIdParentInCache($parent_id)) { // Lưu session nếu chưa có session của id này
					$items = $_SESSION["permisstionFiles"] ?? array();
					$items[] = $parent_id ;
					$_SESSION["permisstionFiles"] = $items;
				}
 
			}
		  
		db_close($conn);
  }

 ?>


    <?php 

        include_once ('../../../lib/auth.php');

        checkLoggedInWeb(); //kiểm tra có quyền truy cập web ko
        
        if (isset($_GET['logout']))   {
            doLogout(); //nếu ko có quyền truy cập sẽ bị logout
        }

        $checkPermision = false;

        $conn = db_connect();
            $id = escapeGetParam($conn, "id");
            $item = findById($conn, $id); // lấy thông tin file chia sẻ

            $item_share = findShareById($conn, $id); // lấy thông tin row table share lưu thông tin type_share, url, password

            $type_permision = "ALL";
			$isIdParentInCache = isIdParentInCache($id);	// kiểm tra xem bạn có quyền xem file này ko

			if (!empty($parent_id)) {  //kiểm tra xe 
				$file_folder = findById($con, $id);
				// $name_parrent = "Tệp tin cha: ".$file_folder['name'];

				if (!$isIdParentInCache) {
 
					
					if (!empty($item_share)) { 
						
						$type_permision = $item_share['type_share'];
					}
					 
				}
			}


        db_close($conn);
 
        $fileLocation =  "http://localhost/project-driver/lib/upload/" . $item['name']; // gán url share 
        
    ?>

	<?php if($type_permision == 'USER_PASSWORD' or $type_permision == 'ALL_PASSWORD') { ?>
				<div class="container">
					<form action="" method="POST">
						    <label for=""><b>Xác nhận mật khẩu</b></label>
							<input type="text" name="password" class="form-control">
							<button name="CONFIRM" class="btn btn-secondary mt-2">Xác nhận</button>
					</form>		
				</div>
					
    <?php } ?>
    <?php if($type_permision == 'ALL' or $type_permision == 'USER'   or $isIdParentInCache == true) { ?>
        <div class="container-fluid">
            <iframe src="<?php echo $fileLocation ?>" title="W3Schools Free Online Web Tutorials" style=" width: 100vw; height: 100vh; "></iframe>
        </div>
    <?php } ?>
</body>
</html>