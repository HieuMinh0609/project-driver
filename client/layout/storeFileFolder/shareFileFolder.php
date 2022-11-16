

<?php 
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
        include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/store_file_folder_service.php");
        include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload.php");

?>

<?php 
   
   
   if(isset($_POST["CREATES"])) {
 
        $user_id = $_SESSION["id"];
     
        $parent_id= null;

        if(isset($_GET['parent_id'])) {
            $parent_id = $_GET['parent_id'];
        }

        $conn = db_connect();
            saveFolder($conn, $parent_id, escapePostParam($conn, "name"),'FOLDER', $user_id);     
        db_close($conn);

        echo '<script type="text/javascript">alert("Thêm mới thành công")</script>';

    }
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../template/upload_file.css"></link>
</head>
 
<body>
 


    <div class="pt-5">
        <div class="container" >
            <div class="center">

                 
                
            </div>      
        </div>
         
    </div>

</body>
</html>