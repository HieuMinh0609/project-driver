
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
    <div class="pt-5">
        <div class="container-fluid" >
            <div class="center">

                <?php 
                   require('../../../lib/db.php');
                   require ('../../../lib/controls.php');
                   require ('../../../lib/service/store_file_folder_service.php');
                ?>

                
                <?php 
                    
                    $conn = db_connect();

                    $id = escapeGetParam($conn, "id");
                    

                    if(deletebyId($conn, $id)) {
                        echo("<br><br><div class=\"container\">
                        <div class=\"alert alert-success\">
                        <strong>Thành công!</strong> Xóa thành công !.
                        </div></div>");
                    } else {
                        echo("<br><br><div class=\"container\">
                        <div class=\"alert alert-danger\">
                        <strong>Thất bại!</strong> Xóa thất bại !.
                        </div></div>");	
                    }
                    
                    db_close($conn);
                
                ?>
                
                <button class="btn btn-secondary ">
                    <a style="color: white" href="/project-driver/client/layout/index.php"> << Quay lại</a>
                </button>
            </div>
          
        </div>
    </div>
 
</body>
</html>