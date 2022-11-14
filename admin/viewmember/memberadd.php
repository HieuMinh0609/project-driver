 <?php include '../includes/FooterHeader/header.php'; ?>



<div class="container-fluid">
        <div class="row">
             
            <div class="link_header">
                <i class="glyphicon glyphicon-hand-right"></i>
                <a href="../viewhome/HomePage.php">Home</a>
                <span>/</span>
                <a href="memberlist.php">Member</a>
                <span>/</span>
                <span>Add</span>
            </div>
        
        </div>
    </div>
    <br><br>
<div class="container">
<?php 
    require("../../lib/controls.php");
    require_once("../../lib/db.php");
    require("../../lib/MemberService.php");



if(isset($_POST['saveMember'])){
    $timenow = date('Y-m-d H:i:s');
    $conn = db_connect();
        createMember($conn, 
            escapePostParam($conn, "nameLogin"), 
            escapePostParam($conn,"nameFull"), 
            md5(escapePostParam($conn,"passWord")),
             $timenow, 
            escapePostParam($conn,"role"), 
            escapePostParam($conn,"sex"), 
            escapePostParam($conn,"place"),
            escapePostParam($conn,"phoneNumber"));    


       
        
        db_close($conn);
}




?>
</div>

<div class="container" style="width: 700px">
 
    <div id="form_register" class="col-md-12 col-sm-12 col-12">
        <form method="POST" class="form-sigin">
            <div class="loginname">
                <input required class="input_name " type="text"  name="nameLogin"  placeholder="Name Login" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>

            </div>
            <div class="loginname">
                <input  required class="input_pass" type="text" name="nameFull"  placeholder="Name Full" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>


            </div>
            <div class="loginname">
                <input required  class="input_pass" type="text" name="passWord" placeholder="Password" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-lock"></i>
						</span>


            </div>
            
            <div class="loginname">
                <input required  class="input_pass" type="text" name="place"  placeholder="Place" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-pencil"></i>
						</span>


            </div>


            <div class="loginname">
                <input  required class="input_pass" type="text" name="phoneNumber" placeholder="Phone Number" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-earphone"></i>
						</span>


            </div>



            <div class="radio">
				 
                    <label><input type="radio" name="sex" value="1" checked>Male</label>
                    <label><input type="radio" name="sex" value="0" >Female</label>
                
            </div>
             
            

            

            <div class="radio">
                <label><input type="radio" value="2"  name="role" checked>Admin</label>

                <label><input type="radio" value="1"  name="role">User</label>
            </div>


            <input type="hidden" name="idUser">

        <div id="btnSave" class="buton_save" >
            <button name="saveMember" class="login_btn_form">Save</button>
          
        </div>
          
        </form>
</div>
</div>
<?php include '../includes/FooterHeader/footer.php'; ?>