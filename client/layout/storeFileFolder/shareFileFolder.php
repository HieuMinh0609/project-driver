

<?php 
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
        include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/share_permission_service.php");
        include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/share_service.php");
        include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/user_service.php");
        include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload.php");

?>

 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../template/client.css"></link>

</head>
 
<body>
                <?php 
                    
                    $conn = db_connect();

                        $id_file_folder = escapeGetParam($conn, "id");

                        $item = findById($conn, $id_file_folder);

                        $url_share = 'http://localhost/project-driver/client/layout/storeFileFolder/fileSearchArea.php?url_share='.md5($item["id"]);

                    db_close($conn);
                
                ?>

                <?php 
                
                    if(isset($_POST["CREATES"])) {
                        $conn = db_connect();
                            
                            startSession();
                            $user_id = $_SESSION["id"];

                           

                            $result = createShare($conn, $id_file_folder, escapePostParam($conn, "url_share"),
                                    escapePostParam($conn, "type_share"), escapePostParam($conn, "password"));

                          

                            if (isset($result)) {
                        
                                if (escapePostParam($conn, "type_share") == 'USER' or  escapePostParam($conn, "type_share") == 'USER_PASSWORD') {
                                    $names = $_POST["name"];
                           
                                    for($i = 0; $i < count($names); $i++) {
                                        $user = getSingleUserByUser($conn, $names[$i]);
                                        if (isset($user)) {
                                           
                                            
                                            
                                            createSharePermission($conn, $result, $user['id']);
                                        }
                                    }
                                }  

                                echo("<br><br><div class=\"container\">
                                    <div class=\"alert alert-success\">
                                    <strong>Thành công!</strong> Chia sẻ thành công!.
                                    </div></div>");
                            }
                          
                        db_close($conn);
                    }

                ?>



    <div class="pt-5">
       <form action="" method="POST">
            <div class="container" >

                <div class="mb-3"><h3>Chia sẻ ".   <?php echo $item["name"] ?>."</h3></div>

               
                   
                 
                <p class="mt-4">Quyền truy cập trung  </p>
                <select class="form-control type-name" name="type_share">
                    <option value="ALL">Bất kì ai có đường liên kết</option>
                    <option value="USER">Người được thêm vào nhóm</option>
                    <option value="USER_PASSWORD">Người được thêm vào nhóm và mật khẩu</option>
                    <option value="ALL_PASSWORD">Bất kì ai có đường liên kết và mật khẩu</option>
                </select>

                <div class="add-member-area mt-2 " style="display:none">
                    <div class="  row">
                        <div class="col-md-10 input-member">
                            <div class="input_field">
                                <input  require class="input-account form-control" disabled  type="text" name="name[]" placeholder="Thêm tài khoản"> 
                            </div>
                           
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-secondary btn-add">Thêm tài khoản</button>
                        </div>    
                    </div>      
                   
                </div>

                <div class="mt-2 password-area" style="display:none">
                    <input id="input-password" require disabled class="form-control" type="text" name="password" placeholder="Thêm mật khẩu"> 
                </div>

                <div class="mt-2">
                    <input id="" name="url_share" readonly class="form-control" type="text" value=" <?php echo $url_share ?>"> 
                </div>

                <button type="submit" name="CREATES" class="btn btn-secondary mt-4">Lưu</button>
            </div>
            <button class="btn btn-secondary ">
                    <a style="color: white" href="/project-driver/client/layout/index.php"> << Quay lại</a>
            </button>     
           
            
       </form>

         
    </div>
 

 
<script type="text/javascript">

    $('.type-name').change(function() {

        if($('.type-name').val() == 'USER') {

            $('.add-member-area').css("display", "block");
            $('.password-area').css("display", "none");
            $('.input-account').prop('disabled', false);
            $('#input-password').prop('disabled', true);
        }

        else if($('.type-name').val() == 'USER_PASSWORD') {
            $('.add-member-area').css("display", "block");
            $('#input-password').prop('disabled', false);
            $('.input-account').prop('disabled', false);
            $('.password-area').css("display", "block");
        }


       else  if($('.type-name').val() == 'ALL_PASSWORD') {

            $('.add-member-area').css("display", "none");
            $('.input-account').prop('disabled', true);

            $('#input-password').prop('disabled', false);


            $('.password-area').css("display", "block");
        } else {
            $('.add-member-area').css("display", "none");
            $('.password-area').css("display", "none");
            $('.input-account').prop('disabled', true);
            $('#input-password').prop('disabled', true);
        }

    });
    
    $('.btn-add').click(function() {
            $('.input-member').append(' <div class="input_field row"> <div class="col-md-8"> <input require class="input-account form-control mt-1"  type="text" name="name[]" placeholder="Thêm tài khoản"></div> <div class="col-md-2  mt-1"><button type="button" class="btn btn-secondary " onclick="removeInputField(this);">Xóa</button></div></div>');
        
    });

    function removeInputField (selectedField) {
        selectedField.closest('.input_field').remove();
    }
    
</script>
</body>
</html>