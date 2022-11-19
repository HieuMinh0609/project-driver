

<?php 
 
    include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
    include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/store_file_folder_service.php");

	
 ?>


<?php 

	include '../layout/header.php';

?>


    <?php 

        $conn = db_connect();
            $id = escapeGetParam($conn,"id");
			$item = findById($conn, $id);
        db_close($conn);
 
        $fileLocation =  "http://localhost/project-driver/lib/upload/" . $item['name'];
        
    ?>
<div class="container-fluid">
 
             
            <div class="link_header">
                <i class="glyphicon glyphicon-hand-right"></i>
                <a href="../index.php">Home</a>
                <span>/</span>
                <a href="list.php">Quản lý tài liệu</a>
                <span>/</span>
                <span>Chi tiết</span>
            </div>
     
    </div>
        <div class="container-fluid mt-4">
            <iframe src="<?php echo $fileLocation ?>" title="W3Schools Free Online Web Tutorials" style=" width: 100vw; height: 100vh; "></iframe>
        </div>