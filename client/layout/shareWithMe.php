 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Driver</title>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../template/client.css"></link>


</head>
<body>
	
	<?php include_once('./layout/header.php') ?>

	<div class="center">
		
		 
		<?php 

			include_once ('../../lib/db.php');
			include_once ('../../lib/controls.php');
		 
		 ?>

		<?php include_once('../layout/storeFileFolder/listShareWithMe.php') ?>
		<?php include_once('../layout/storeFileFolder/uploadFile.php') ?>
		<?php include_once('../layout/storeFileFolder/createFolder.php') ?>
 
		
	</div>
 
</body>
</html>