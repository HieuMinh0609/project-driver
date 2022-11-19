<?php 	include '../layout/header.php'; ?>


<div class="container-fluid">
        
             
            <div class="link_header">
                <i class="glyphicon glyphicon-hand-right"></i>
                <a href="../index.php">Home</a>
                <span>/</span>
                <a href="list.php">Quản lý người dùng</a>
                <span>/</span>
                <span>Thêm mới</span>
            </div>
        
   
    </div>
    <br><br>
<div class="container">
<?php 

 
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/share_permission_service.php");
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/share_service.php");
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/user_service.php");
include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload.php");


if(isset($_POST['CREATES'])){
    $timenow = date('Y-m-d H:i:s');
    $conn = db_connect();
        createUser($conn, 
        escapePostParam($conn, "username"), 
        md5(escapePostParam($conn,"password")), 
        1, 
        escapePostParam($conn,"email"), 
        escapePostParam($conn,"address"),
        escapePostParam($conn,"phone"), 
        escapePostParam($conn,"gender"), 
        escapePostParam($conn,"full_name"),
        $timenow,  escapePostParam($conn,"role"));    
    db_close($conn);
}




?>
</div>

<div class="container" style="width: 700px">
 
    <div id="form_register" class="col-md-12 col-sm-12 col-12">
        <form method="POST" class="form-sigin">
            <div class="mt-2">
                <lable ><b>username </b></label>
                <input required  class="form-control" type="text"  name="username"  >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>

            </div>
            <div class="mt-2">
                <lable ><b>Tên </b></label>
                <input  required  class="form-control" type="text" name="full_name"  >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>


            </div>
            <div class="mt-2">
                <lable ><b>Mật khẩu</b></label>
                <input required   class="form-control" type="text" name="passWord"  >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-lock"></i>
						</span>


            </div>
            
            <div class="mt-2">
                <lable ><b>Địa chỉ</b></label>
                <input required  class="form-control" type="text" name="address"  >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-pencil"></i>
						</span>


            </div>

            <div class="mt-2">
                <lable ><b>Email</b></label>
                <input required  class="form-control" type="email" name="email"  >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-pencil"></i>
						</span>


            </div>



            <div class="mt-2">
                <lable ><b>Điện thoại</b></label>
                <input  required  class="form-control" type="text" name="phone" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-earphone"></i>
						</span>


            </div>



            <div class="radio mt-2">
				 
                    <label><input  type="radio" name="gender" value="1" checked>Male</label>
                    <label><input type="radio" name="gender" value="0" >Female</label>
                
            </div>
             
            

            

            <div class="radio mt-2">
                <label><input type="radio" value="ADMIN"  name="role" checked>Admin</label>

                <label><input type="radio" value="USER"  name="role">User</label>
            </div>


            <input type="hidden" name="id">

        <div id="btnSave" class="buton_save" >
            <button name="CREATES" type="submit" class="btn btn-secondary">Lưu</button>
          
        </div>
          
        </form>
</div>
</div>
 