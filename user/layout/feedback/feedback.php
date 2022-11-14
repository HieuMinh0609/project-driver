<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Flowers.com</title>
	<link rel="stylesheet" href="../../bootstrap/css/style.css">
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../bootstrap/js/bootstrap.min.js">
	<script src="../../bootstrap/js/jquery-3.4.1.min.js"></script>
	 <script src="../../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>



	<?php include_once('../include/header.php') ?>
	
<?php 

include_once ('../../lib/db.php');
include_once ('../../lib/controls.php');
include_once ('../../lib/auth.php');
include_once ('../../lib/feedback_service.php');
include_once ('../../lib/member_service.php');

include_once ('../../lib/auth.php');

if( isset($_POST['feedback'])){
	 $timenow = date('Y-m-d H:i:s');
	 $con =db_connect();

	 $username = getLoggedInUser();


	 $idUser =getIdUser($username);

	 
	$content= $_POST['content'];
 	 
	SaveFeedBack( $con,$timenow,$content,$idUser,1);
	db_close($con);

	echo '<script language="javascript">';
	  echo 'alert("Phản hồi thành công!")';  //not showing an alert box.
	  echo '</script>';
	   

	   
	
}


?>






	<div style="margin: 10px; text-align: center;">
		<form   method="post">
		<textarea name="content" required placeholder="Viết phản hồi tại đây..." cols="50" rows="4"></textarea>
		<br>
		<button type="submit" name="feedback" class="btn btn-warning">Send</button>
		</form>
	</div>

	<?php include_once('../include/footer.php') ?>
</body>
</body>
</html>