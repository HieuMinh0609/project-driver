 <?php include '../includes/FooterHeader/header.php'; ?>

<div class="container-fluid">
        <div class="row">
             
            <div class="link_header">
                <i class="glyphicon glyphicon-hand-right"></i>
                <a href="../viewhome/HomePage.php">Home</a>
                <span>/</span>
                <a href="memberlist.php">Member</a>
                <span>/</span>
                <span>Edit</span>
            </div>
        
        </div>
    </div>

<?php   
 require("../../lib/controls.php");
require_once("../../lib/db.php");
require("../../lib/MemberService.php"); 
        $conn = db_connect();
        $idmember = escapeGetParam($conn,"id");
        db_close($conn);





?>



<div class="container">

<?php 
    
if(isset($_POST['saveMember'])){
   
    $conn = db_connect();
        updateMember($conn,$idmember, 
            escapePostParam($conn, "nameLogin"), 
            escapePostParam($conn,"nameFull"), 
            md5(escapePostParam($conn,"passWord")),
            escapePostParam($conn,"role"), 
            escapePostParam($conn,"sex"), 
            escapePostParam($conn,"place"),
            escapePostParam($conn,"phoneNumber"));     
        db_close($conn);
}



?>
</div>


<?php    
 
        $conn = db_connect();
        

         $row= getSingleMember($conn,$idmember); 
        db_close($conn);


?>


    <br><br>


<div class="container" style="width: 700px">
 
    <div id="form_register" class="col-md-12 col-sm-12 col-12">
        <form method="POST" class="form-sigin">
            <div class="loginname">
                <input required class="input_name " type="text" value="<?= $row['namelogin'] ?>" name="nameLogin"  placeholder="Name Login" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>

            </div>
            <div class="loginname">
                <input  required class="input_pass" type="text"  value="<?= $row['fullname'] ?>" name="nameFull"  placeholder="Name Full" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-user"></i>
						</span>


            </div>

             <div class="loginname">
                <input  readonly class="input_pass" type="text" value="<?= $row['createdate'] ?>" name="createdate" placeholder="Create" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                        <i class="glyphicon glyphicon-calendar"></i>
                        </span>


            </div>

            <div class="loginname">
                <input required  class="input_pass" type="text"  value="<?= $row['password'] ?>" name="passWord" placeholder="Password" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-lock"></i>
						</span>


            </div>
            
            <div class="loginname">
                <input required  class="input_pass" type="text" name="place"  value="<?= $row['address'] ?>" placeholder="Place" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-pencil"></i>
						</span>


            </div>


            <div class="loginname">
                <input  required class="input_pass" type="text"  value="<?= $row['phone'] ?>" name="phoneNumber" placeholder="Phone Number" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-earphone"></i>
						</span>


            </div>

             <div class="radio">
            <?php 
                if($row['sex']!=null){
                    if($row['sex']==1){
                        echo ("<label><input type=\"radio\" name=\"sex\" value=\"1\" checked>Male</label> ");
                        echo ("<label><input type=\"radio\" name=\"sex\" value=\"10\">Female</label> ");
                    }else{
                          echo ("<label><input type=\"radio\" name=\"sex\" value=\"1\" >Male</label> ");
                        echo ("<label><input type=\"radio\" name=\"sex\" value=\"10\" checked >Female</label> ");
                    }
                }

             ?>                
             </div>
             
            

            

            <div class="radio">
             <?php 
            if($row['idrole']!=null){
                if($row['idrole']==1){
                    echo ("<label><input type=\"radio\" value=\"2\"  name=\"role\" >Admin</label>");
                    echo ("<label><input type=\"radio\" value=\"1\"  name=\"role\" checked>User</label>");
                }else{
                    echo ("<label><input type=\"radio\" value=\"2\"  name=\"role\" checked>Admin</label>");
                    echo ("<label><input type=\"radio\" value=\"1\"  name=\"role\" >User</label>");
                }
            }

             ?>            
            </div>


            <input type="hidden" name="idUser">

        <div id="btnSave" class="buton_save" >
            <button name="saveMember" class="btn btn-warning">Update</button>
          
        </div>
          
        </form>
</div>
</div>
<?php include '../includes/FooterHeader/footer.php'; ?>