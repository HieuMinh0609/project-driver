<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>

    <script type="text/javascript" src="../admin/content/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
     <link rel="stylesheet" type="text/css" href="template/login.css">

</head>
<body>
    <div class="container">
<?php
    include '../lib/auth.php';
    require_once("../lib/db.php");
    require("../lib/service/user_service.php");



if(isset($_POST['register'])){
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
            $timenow, 'USER');    

    db_close($conn);
}


 if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
        $conn = db_connect();
        $username =   $_COOKIE["username"];
        $password =   $_COOKIE["password"];
      
        
        if(!doLogin($conn,$username, $password)) {
            $resultMess ="Tài khoản mật khẩu không đúng !";
        }else{
            $isMember = isMember($conn,$username,$password);
            $result=  $isMember['role'];
        }
        if($resultMess==""){
              if('ADMIN'==$result){
            redirect("../admin/viewhome/HomePage.php");
        }else if('USER'==$result) {
            redirect("../client/layout/index.php");
        }
         
        }
        db_close($conn);

}

    $resultMess="";
    if(isset($_POST["login"])) {
     $conn = db_connect();
        $username =  escapePostParam($conn, "username");
        $password =  escapePostParam($conn, "password");
      
        $user = md5($password);
        echo $user;
        if(!doLogin($conn,$username, md5($password))) {
            $resultMess ="Tài khoản hoặc mật khẩu không đúng !";
        } else {
            $isMember = isMember($conn,$username, md5($password));
            $result =  $isMember['role'];
        }
        if($resultMess==""){
              if('ADMIN'==$result){
            redirect("../admin/viewhome/HomePage.php");
        }else if('USER'==$result) {
            redirect("../client/layout/index.php");
        }
         
        }
      

        db_close($conn);

    }
?>
</div>

 
    <div id="contaiter" style="margin-top: 150px; margin-bottom: 100px">
        <a id="adangky" href="#" class="tab" onclick="ondangky()">Đăng Ký</a>
        <a id="adangnhap" href="#" class="tab" onclick="ondangnhap()">Đăng Nhập</a>


        <div id="divdangnhap" class="divdangnhap1" style="display: block">
            <form class="fmdangky" action="login.php" method="post">
                <div class="tieude">
                    <h2>Đăng nhập</h2>
                    <hr>
                </div>
                <?php 
                if( $resultMess!="") {

                echo("<div class=\"dthongbao\" style=\"margin-right: 100px;\">
                <p >".$resultMess."</p>             
                </div>");
                }
                 ?>

                <table  class="form-login">

                    <tr>
                        <td>Tên đăng nhập:</td>
                        <td><input required type="text" name="username" id="tendangnhap" class="form-control"></td>
                    </tr>

                    <tr>
                        <td>Mật khẩu: </td>
                        <td><input required type="password" name="password" id="matkhau" class="form-control"></td>
                    </tr>
                    </tr>
                   

                    <tr>
                        <td colspan="3" style="text-align:center">
                            <button type="submit" name="login"   class="dangkysumbit">Đăng nhập</button>
                        </td>
                    </tr>
                        <tr>
                        <td colspan="3" style="text-align:center">
                            <i onclick="forgot_pass()" class="forgot_pass" style="cursor: pointer ; color: #9797de;">Quên mật khẩu?</i>
                            <br>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align:center">
                            Bạn chưa có tài khoản? vui lòng đăng ký
                        </td>
                    </tr>
                </table>

            </form>
        </div>
        <div id="divdangky" class="divdangky1" style="display: none">
            <form id="fmdangky" action="login.php" method="post">
                <div class="tieude">
                    <h2>Đăng ký tài khoản</h2>
                    <hr>
                </div>
                <div class="dthongbao" style="margin-right: 100px;">
                    <p id="pthongbao2" style="color: red ; background-color: yellow; text-align: center;" ></p>
                </div>

                <table class="form-login">

                    <tr>
                        <td>Tên đăng nhập:</td>
                        <td><input required id="inputnamelogin"  name="username" type="text" id="tendangky"  class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Mật khẩu: </td>
                        <td><input required name="password" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Tên đầy đủ: </td>
                        <td><input required type="text" name="full_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td><input required type="text" name="address" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><input required type="email" name="email" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại: </td>
                        <td><input required type="text" name="phone"  class="form-control"></td>
                    </tr>
                    <td> Giới tính: </td>
                    <td><input type="radio" value="1" id="nam" name="gender">&emsp;Nam</input>&emsp;
                        <input type="radio" id="nu" value="0" name="gender">&emsp;Nữ</input>
                    </td>
                    <tr>
                        <td colspan="3" style="text-align:center"><span id="thongbaogioitinh"></span>   </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align:center">
                            <button type="submit"  name="register" class="dangkysumbit2"  onclick="return validateData()" >Đăng ký</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center">
                            Bạn đã có tài khoản? vui lòng chọn đăng ký
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="urlType" value="url_register">
            </form>
        </div>


    </div>
    <script>
    
    function forgot_pass() {
           $t_email = prompt("Nhập email bạn", '');
           $t_namelogin = prompt("Nhập name login bạn", '');
           $t_phone = prompt("Nhập phone number bạn", '');
           
             var dataArray=[];

            dataArray["email"]= $t_email;
            dataArray["namelogin"]= $t_namelogin;
            dataArray["phone"]=$t_phone;
            $.ajax({
            url : 'ajax/ResetPassword.php',
            type : 'post',
            dataType : 'json',
            data : {'email': $t_email , 'phone': $t_phone ,'namelogin' : $t_namelogin},
            success : function (result) {
                if(result==1){
                    alert("Success! check email of you");
                }else{
                    alert("Wrong! name login or phone not true");
                }
        },
        error: function (result){
            alert("Wrong! name login or phone not true");       
        }
    });

    }
 
    function validateData() {
      var username = document.getElementById("inputnamelogin")
        if(username.value ==""){
          document.getElementById("pthongbao2").innerHTML="Đăng ký không thành công";
          document.getElementById("pthongbao2").style.display="block";
          document.getElementById("inputnamelogin").style.border="solid 2px red";

            return false;
        }
        return true;
    }
    var form = document.getElementById('fmdangky');
    form.addEventListener('submit', validateData, false);


    function ondangky(){

        var divdk= document.getElementById("divdangky");
        var divdn= document.getElementById("divdangnhap");
        divdk.style.display="block";
        divdn.style.display="none";
    }

    function ondangnhap() {

        var divdk= document.getElementById("divdangky");
        var divdn= document.getElementById("divdangnhap");
        divdn.style.display="block";
        divdk.style.display="none";
    }

</script>
</body>
</html>