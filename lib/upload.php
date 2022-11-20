<?php

include_once ($_SERVER["DOCUMENT_ROOT"] .'/project-driver/lib/service/store_file_folder_service.php');

include_once ($_SERVER["DOCUMENT_ROOT"] .'/project-driver/lib/service/system_config_service.php');
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");

function checkFileSize($sizeFile) {
    $conn =db_connect();
        $item = getSingleSystemConfigByCode($conn, "MAX_SIZE_FILE");
    db_close($conn);
  
        if ((int) $item["value"] >=  $sizeFile ) {
            return false;
        }
    return true;    
}

function checkFormatImage($fileType) {
    $conn =db_connect();
        $item = getSingleSystemConfigByCode($conn, "FILE_NO_UPLOAD");
    db_close($conn);

    $dataTypes =  explode("\,", $item['value']); 
 
    if( in_array( $fileType ,$dataTypes ) ) {
        return false;
    }
    return true;    
}

function uploadFiles($files, $parent_id, $user_id) {
    for($count = 0; $count < count($_FILES['files']['name']); $count++) {
        $target_dir = $_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload/";
  
        echo  " - " .$files["name"][$count]."<br>";

        $target_file = $target_dir . basename($files["name"][$count]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
        // Check file size
        if (checkFileSize($files["size"][$count] )) {
            echo " File quá lớn<br>";
            $uploadOk = 0;
        }

        if (checkFormatImage($files["size"][$count] )) {
            echo " File quá lớn<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if( checkFormatImage($imageFileType)) {
            echo "File tải lên không đúng định dạng<br>";
            $uploadOk = 0;
        }

 
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "File của bạn chưa được upload<br>";
            // if everything is ok, try to upload file
        } else {

            
            $uuid = generateRandomString(10);

            if (file_exists($target_file)) {
                $conn =db_connect();
                    save($conn, $parent_id, $files["name"][$count], "FILE", $user_id, $uuid.$files["name"][$count]);
                db_close($conn);
                echo "File ". htmlspecialchars( basename( $files["name"][$count])). " đã được upload. <br>";

            } else if (move_uploaded_file($files["tmp_name"][$count], $target_file)) {

                $conn =db_connect();
                    save($conn, $parent_id, $files["name"][$count], "FILE", $user_id, $uuid.$files["name"][$count]);
                db_close($conn);
                echo "File ". htmlspecialchars( basename( $files["name"][$count])). " đã được upload. <br>";

            } else {
                echo "Lỗi upload file<br>";
            }
        }
    }
}
    
?>
