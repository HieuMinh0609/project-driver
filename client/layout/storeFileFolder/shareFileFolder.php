

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


<?php 
                    $isShare = false;
                    $conn = db_connect();

                        $id_file_folder = escapeGetParam($conn, "id");

                        $itemShare= findShareById($conn, $id_file_folder);
                        
                        if(!empty($itemShare)) {

                            $usersPermission = findSharePermissionByShareId($conn, $itemShare['id']);
   
                            $isShare = true;
                        }

                     

                    db_close($conn);
                
                ?>

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
                                    <strong>Th??nh c??ng!</strong> Chia s??? th??nh c??ng!.
                                    </div></div>");
                            }
                          
                        db_close($conn);
                    }

                    if(isset($_POST["DELETES"])) {
                        $conn = db_connect();  
                            if(deleteByIdFile($conn, $id_file_folder)) {
                                echo("<br><br><div class=\"container\">
                                <div class=\"alert alert-success\">
                                <strong>Th??nh c??ng!</strong> X??a th??nh c??ng!.
                                </div></div>");
                            } else {
                                echo("<br><br><div class=\"container\">
                                <div class=\"alert alert-warning\">
                                <strong>L???i!</strong> X??a th???t b???i!.
                                </div></div>");
                            }
                        db_close($conn);
                    }


                ?>


<?php if( $isShare == true) { ?>      
    <div class="pt-5">
       <form action="" method="POST">
            <div class="container" >

                <div class="mb-3"><h3>Chia s??? ".   <?php echo $item["name"] ?>."</h3></div>

               
             
                 
                <p class="mt-4">Quy???n truy c???p trung  </p>
                <select class="form-control type-name" name="type_share">
                    <option value="<?php echo $itemShare['type_share'] ?>">
 
                    <?php 
                        if ($itemShare['type_share'] == 'ALL') echo "B???t k?? ai c?? ???????ng li??n k???t";
                        else if ($itemShare['type_share'] == 'USER')  echo "Ng?????i ???????c th??m v??o nh??m";
                        else if ($itemShare['type_share'] == 'USER_PASSWORD')  echo "Ng?????i ???????c th??m v??o nh??m v?? m???t kh???u";
                        else if ($itemShare['type_share'] == 'ALL_PASSWORD')  echo "B???t k?? ai c?? ???????ng li??n k???t v?? m???t kh???u";
                    ?>
                </option>
                </select>

                <div class="add-member-area mt-2 ">
                    <div class="  row">
                        <div class="col-md-10 input-member">
                        <?php while ($userItem = mysqli_fetch_array($usersPermission)) {?>	
                            <div class="input_field">
                                <input  require class="input-account form-control" readonly value="<?php echo $userItem['username'] ?>"  type="text" name="name[]" placeholder="Th??m t??i kho???n"> 
                            </div>
                        <?php } ?>   
                        </div>
  
                    </div>      
                   
                </div>

                <?php if( $itemShare['type_share'] == 'USER_PASSWORD' or $itemShare['type_share'] == 'ALL_PASSWORD') { ?>  
                    <div class="mt-2 password-area" >
                        <input id="input-password" require readonly class="form-control" value="<?php echo $itemShare['password'] ?>" type="text" name="password" placeholder="Th??m m???t kh???u"> 
                    </div>
                <?php } ?>   

                <div class="mt-2">
                    <input id="" name="url_share" readonly class="form-control" type="text" value="<?php echo $url_share ?>"> 
                </div>

                <button type="submit" name="DELETES" onclick="return confirm('B???n c?? ch???c ch???n mu???n x??a ?')"  class="btn btn-warning mt-4">X??a</button>
            </div>
            <button class="btn btn-secondary ">
                    <a style="color: white" href="/project-driver/client/layout/index.php"> << Quay l???i</a>
            </button>     
           
            
       </form>

         
    </div>
 
<?php } ?>

<?php if( $isShare == false) { ?> 
    <div class="pt-5">
       <form action="" method="POST">
            <div class="container" >

                <div class="mb-3"><h3>Chia s??? ".   <?php echo $item["name"] ?>."</h3></div>

                <p class="mt-4">Quy???n truy c???p trung  </p>
                <select class="form-control type-name" name="type_share">
                    <option value="ALL">B???t k?? ai c?? ???????ng li??n k???t</option>
                    <option value="USER">Ng?????i ???????c th??m v??o nh??m</option>
                    <option value="USER_PASSWORD">Ng?????i ???????c th??m v??o nh??m v?? m???t kh???u</option>
                    <option value="ALL_PASSWORD">B???t k?? ai c?? ???????ng li??n k???t v?? m???t kh???u</option>
                </select>

                <div class="add-member-area mt-2 " style="display:none">
                    <div class="  row">
                        <div class="col-md-10 input-member">
                            <div class="input_field">
                                <input  require class="input-account form-control" disabled  type="text" name="name[]" placeholder="Th??m t??i kho???n"> 
                            </div>
                           
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-secondary btn-add">Th??m t??i kho???n</button>
                        </div>    
                    </div>      
                   
                </div>

                <div class="mt-2 password-area" style="display:none">
                    <input id="input-password" require disabled class="form-control" type="text" name="password" placeholder="Th??m m???t kh???u"> 
                </div>

                <div class="mt-2">
                    <input id="" name="url_share" readonly class="form-control" type="text" value="<?php echo $url_share ?>"> 
                </div>

                <button type="submit" name="CREATES" class="btn btn-secondary mt-4">L??u</button>
            </div>
            <button class="btn btn-secondary ">
                    <a style="color: white" href="/project-driver/client/layout/index.php"> << Quay l???i</a>
            </button>     
           
            
       </form>

         
    </div>
<?php } ?>

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
            $('.input-member').append(' <div class="input_field row"> <div class="col-md-8"> <input require class="input-account form-control mt-1"  type="text" name="name[]" placeholder="Th??m t??i kho???n"></div> <div class="col-md-2  mt-1"><button type="button" class="btn btn-secondary " onclick="removeInputField(this);">X??a</button></div></div>');
        
    });

    function removeInputField (selectedField) {
        selectedField.closest('.input_field').remove();
    }
    
</script>
</body>
</html>