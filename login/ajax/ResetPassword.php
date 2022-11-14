<?php 
 header('Content-Type: text/html; charset=utf-8');
   
  require_once("../../lib/db.php");
  require("../../lib/MemberService.php");
  require("../../lib/PHPMailer/src/PHPMailer.php");
  require("../../lib/PHPMailer/src/SMTP.php");
  require("../../lib/PHPMailer/src/Exception.php");

   $conn = db_connect();


   $phone = escapePostParam($conn, "phone");
   $namelogin = escapePostParam($conn, "namelogin");
   $email = escapePostParam($conn, "email");

    

   $result =getSingleMember_forgotpass($conn,$phone,$namelogin);   
 db_close($conn);
 		 
   if($result==1){
   	$pass = generateRandomString();
	$mail =   new PHPMailer\PHPMailer\PHPMailer();

	$mail->IsSMTP(); 

    $mail->CharSet="UTF-8";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPDebug = 1; 
    $mail->Port = 465 ; //465 or 587

     $mail->SMTPSecure = 'ssl';  
    $mail->SMTPAuth = true; 
    $mail->IsHTML(true);
    $mail->SMTPDebug = false;
    $mail->do_debug = 0;
    //Authentication
    $mail->Username = "hieu6908@gmail.com";
    $mail->Password = "nguyenhieu97";

    //Set Params
    $mail->SetFrom("hieu6908@gmail.com");
    $mail->AddAddress($email);
    $mail->Subject = "Reset your password";
    $mail->Body = "New Password : ".$pass;

   if(!$mail->send()){
   		$result=0;
 	} else {
 		$result=1;
 	}
   
    $conn = db_connect();
     	updatePassword($conn,md5($pass),$phone);
 	db_close($conn);
   } 


  


 
die (json_encode($result));



?>