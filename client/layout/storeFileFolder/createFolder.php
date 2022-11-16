

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

                <!-- Modal -->
                <div class="modal fade " id="createFolder" tabindex="-1" role="dialog" aria-labelledby="createFolder " aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                             
                            <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><b>Tên thư mục</b> </label>
                                        <input type="text" require class="form-control" name="name"  id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <button type="submit" name="CREATES" class="btn btn-secondary mt-5" onclick="return confirm('Bạn có chắc chắn muốn tạo mới ?')" >Tạo mới</button>
                            </form>
                    </div>
                
                </div>
                </div>
                </div>
                
            </div>      
        </div>
         
    </div>
 

 

</body>
</html>