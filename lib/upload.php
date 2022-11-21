<?php

include_once ($_SERVER["DOCUMENT_ROOT"] .'/project-driver/lib/service/store_file_folder_service.php');
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");

//Hàm upload nhiều file cùng lúc 

function uploadFiles($files, $parent_id, $user_id) {

    for($count = 0; $count < count($_FILES['files']['name']); $count++) {
        $target_dir = $_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload/"; // địa chỉ thư mục tài file
  
        echo  " - " .$files["name"][$count]."<br>";

        $target_file = $target_dir . basename($files["name"][$count]); //nối địa chỉ thư mục với tên file
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //lấy định dạng file (txt, png)

 
        // Kiểm tra kích thước file 
        if ($files["size"][$count] > 500000) {
            echo " File quá lớn<br>"; // in thông điệp ra giao diện
            $uploadOk = 0;
        }

    

        // kiểm tra nếu $uploadOk = 0 thì không được tải file
        if ($uploadOk == 0) {
            echo "File của bạn chưa được upload<br>"; // in thông điệp ra giao diện
            // if everything is ok, try to upload file
        } else {

            // tạo ngẫu nhiên số để nối vào tên file mục đích để không bị trùng tên file
            // bằng hàm generateRandomString() trong '/project-driver/lib/service/store_file_folder_service.php'
            $uuid = generateRandomString(10);

            // kiểm tra xem file có tồn tại không nếu không tồn tại thì sẽ tạo ra file mới và lưu xuống db , nếu tồn tại file thì chỉ lưu data xuống db
            if (file_exists($target_file)) {
                $conn =db_connect(); // kết nối database
                    save($conn, $parent_id, $files["name"][$count], "FILE", $user_id, $uuid.$files["name"][$count]); // hàm save trong '/project-driver/lib/service/store_file_folder_service.php'
                db_close($conn);// đóng kết nối database
                echo "File ". htmlspecialchars( basename( $files["name"][$count])). " đã được upload. <br>"; // in thông điệp ra giao diện

            } else if (move_uploaded_file($files["tmp_name"][$count], $target_file)) { // hàm upload file

                $conn =db_connect();
                    save($conn, $parent_id, $files["name"][$count], "FILE", $user_id, $uuid.$files["name"][$count]);
                db_close($conn);
                echo "File ". htmlspecialchars( basename( $files["name"][$count])). " đã được upload. <br>"; // in thông điệp ra giao diện

            } else {
                echo "Lỗi upload file<br>";
            }
        }
    }
}
    
?>
