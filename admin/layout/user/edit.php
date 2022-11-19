<?php 	include '../layout/header.php'; ?>

<div class="container-fluid">
 
             
            <div class="link_header">
                <i class="glyphicon glyphicon-hand-right"></i>
               <a href="../index.php">Home</a>
                <span>/</span>
                <a href="list.php">Quản lý người dùng</a>
                <span>/</span>
                <span>Sửa</span>
            </div>
        
 
    </div>

<?php   
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/user_service.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload.php");

        $conn = db_connect();
        $idmember = escapeGetParam($conn,"id");
        db_close($conn);





?>



<div class="container">

<?php 
    
if(isset($_POST['UPDATES'])){
   
    $conn = db_connect();
        updateMember($conn,$idmember, 
            escapePostParam($conn, "username"), 
            escapePostParam($conn,"full_name"), 
            md5(escapePostParam($conn,"passWord")),
            escapePostParam($conn,"role"), 
            escapePostParam($conn,"gender"), 
            escapePostParam($conn,"address"),
            escapePostParam($conn,"phone"), escapePostParam($conn,"status"));     
        db_close($conn);
}



?>
</div>


<?php    
 
        $conn = db_connect();
        

         $row= getSingleUser($conn,$idmember); 
        db_close($conn);


?>


    <br><br>


<div class="container" style="width: 700px">
 
    <div id="form_register" class="col-md-12 col-sm-12 col-12">
        <form method="POST" class="form-sigin">
            <div class="loginname">
                <lable ><b>username</b></label>
                <input required   class="form-control" type="text" value="<?= $row['username'] ?>" name="username"  placeholder="Name Login" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>

            </div>
            <div class="loginname">
                <lable ><b>Tên</b></label>
                <input  required  class="form-control" type="text"  value="<?= $row['full_name'] ?>" name="full_name"  placeholder="Name Full" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>


            </div>
 

            <div class="loginname">
                <lable ><b>Mật khẩu</b></label>
                <input required  class="form-control" type="text"  value="<?= $row['password'] ?>" name="passWord" placeholder="Password" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-lock"></i>
						</span>


            </div>
            
            <div class="loginname">
                <lable ><b>Địa chỉ</b></label>
                <input required  class="form-control" type="text" name="address"  value="<?= $row['address'] ?>" placeholder="Place" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-pencil"></i>
						</span>


            </div>


            <div class="loginname">
                 <lable ><b>Điện thoại</b></label>
                <input  required  class="form-control" type="text"  value="<?= $row['phone'] ?>" name="phone" placeholder="Phone Number" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-earphone"></i>
						</span>


            </div>

             <div class="radio mt-2">
            <?php 
                if($row['gender']!=null){
                    if($row['gender']==1){
                        echo ("<label><input  type=\"radio\" name=\"gender\" value=\"1\" checked>Male</label> ");
                        echo ("<label><input class=\"ml-2\" type=\"radio\" name=\"gender\" value=\"10\">Female</label> ");
                    }else{
                          echo ("<label><input class=\"ml-2\" type=\"radio\" name=\"gender\" value=\"1\" >Male</label> ");
                        echo ("<label><input type=\"radio\" name=\"gender\" value=\"10\" checked >Female</label> ");
                    }
                }

             ?>                
             </div>
             
            

            

            <div class="radio">
             <?php 
            if($row['role']!=null){
                if($row['role']=='USER'){
                    echo ("<label><input type=\"radio\" value=\"ADMIN\"  name=\"role\" >ADMIN</label>");
                    echo ("<label><input type=\"radio\" class=\"ml-2\" value=\"USER\"  name=\"role\" checked>USER</label>");
                }else{
                    echo ("<label><input type=\"radio\" value=\"ADMIN\"  name=\"role\" checked>ADMIN</label>");
                    echo ("<label><input type=\"radio\" class=\"ml-2\" value=\"USER\"  name=\"role\" >USER</label>");
                }
            }

            ?>  
            
            <div class="radio">
             <?php 
            if($row['status']!=null){
                if($row['status']=='1'){
                    echo ("<label><input type=\"radio\" value=\"1\"  name=\"status\" checked>Hoạt động</label>");
                    echo ("<label><input type=\"radio\" class=\"ml-2\" value=\"0\"  name=\"status\" >Khóa</label>");
                }else{
                    echo ("<label><input type=\"radio\" value=\"1\"  name=\"status\" checked>Hoạt động</label>");
                    echo ("<label><input type=\"radio\" class=\"ml-2\" value=\"0\"  name=\"status\" >Khóa</label>");
                }
            }

            ?>  
            
            </div>


            <input type="hidden" name="idUser">

        <div id="btnSave" class="buton_save" >
            <button name="UPDATES" class="btn btn-warning">Cập nhật</button>
          
        </div>
          
        </form>
</div>
</div>
 