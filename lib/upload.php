<?php

include_once ($_SERVER["DOCUMENT_ROOT"] .'/project-driver/lib/service/store_file_folder_service.php');
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");

function uploadFiles($files, $parent_id, $user_id) {
    for($count = 0; $count < count($_FILES['files']['name']); $count++) {
        $target_dir = $_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload/";
  
        echo  " - " .$files["name"][$count]."<br>";

        $target_file = $target_dir . basename($files["name"][$count]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
        //     $check = getimagesize($files["tmp_name"]);
        //     if($check !== false) {
        //         echo "File is an image - " . $check["mime"] . ".";
        //         $uploadOk = 1;
        //     } else {
        //         echo "File is not an image.";
        //         $uploadOk = 0;
        //     }
        // }
 
        // Check file size
        if ($files["size"][$count] > 500000) {
            echo " File quá lớn<br>";
            $uploadOk = 0;
        }

        // // Allow certain file formats
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        // && $imageFileType != "gif" ) {
        //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     $uploadOk = 0;
        // }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "File của bạn chưa được upload<br>";
            // if everything is ok, try to upload file
        } else {

          

            if (file_exists($target_file)) {
                $conn =db_connect();
                    save($conn, $parent_id, $files["name"][$count], "FILE", $user_id, $target_file);
                db_close($conn);
                echo "File ". htmlspecialchars( basename( $files["name"][$count])). " đã được upload. <br>";

            } else if (move_uploaded_file($files["tmp_name"][$count], $target_file)) {

                $conn =db_connect();
                    save($conn, $parent_id, $files["name"][$count], "FILE", $user_id, $target_file);
                db_close($conn);
                echo "File ". htmlspecialchars( basename( $files["name"][$count])). " đã được upload. <br>";

            } else {
                echo "Lỗi upload file<br>";
            }
        }
    }
}
    
?>
