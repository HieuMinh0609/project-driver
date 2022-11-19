<?php 	include '../layout/header.php'; ?>

<div class="container-fluid">
        
             
            <div class="link_header">
                <i class="glyphicon glyphicon-hand-right"></i>
                <a href="../index.php">Home</a>
                <span>/</span>
                <a href="list.php">Quản lý cấu hình hệ thống</a>
                <span>/</span>
                <span>Thêm mới</span>
            </div>
      
    </div>

<?php   
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/system_config_service.php");
 
 


?>



<div class="container">

<?php 
    
if(isset($_POST['CREATES'])){
   
    $conn = db_connect();
 
    createSystemConfig($conn,
            escapePostParam($conn, "code"), 
            escapePostParam($conn,"name"), 
           escapePostParam($conn,"value"));   
    db_close($conn);
}



?>
</div>


 


    <br><br>


<div class="container" style="width: 700px">
 
    <div id="form_register" class="col-md-12 col-sm-12 col-12">
        <form method="POST" class="form-sigin">
            <div class="loginname">
                <lable ><b>Mã cấu hình</b></label>
                <input required   class="form-control" type="text" value="" name="code"   >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>

            </div>
            <div class="loginname">
                <lable ><b>Tên</b></label>
                <input  required  class="form-control" type="text"  value="" name="name"    >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>


        </div>
        <div class="loginname">
                <lable ><b>Gía trị</b></label>
                <input  required  class="form-control" type="text"  value="" name="value"   >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>


        </div>


        <div id="btnSave" class="buton_save mt-2" >
            <button name="CREATES" class="btn btn-warning">Cập nhật</button>
          
        </div>
          
        </form>
</div>
</div>
 