 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Driver Admin</title>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../template/admin.css"></link>


</head>
<body>


<?php 
 
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/system_config_service.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload.php");

 

?>

<?php 

	include '../layout/header.php';

?>

<div class="container-fluid mt-2">
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="../index.php">Home</a>
				<span>/</span>
				<span>Quản lý cấu hình hệ thống</span>
			</div>
	</div>
 
<div class="container mt-3">
 

	<div class="container" >
		<a href="add.php" class="btn btn-primary mt-2" style="float:right">Thêm mới</a>
	
	</div>
	<br>
</div>


<?php 
 
	$limit =10000000;
	$offer = 0;;
	
	

	$conn = db_connect();
	$result = getAllSystemConfig($conn);

	printTable($result, 
		["id" => "ID", 
		"code" => "Mã cấu hình",
		"name" => "Tên",
		"value"=> "Gía trị"
	],
		"edit.php","id","delete.php","",null,"","");

	db_close($conn);
?>
 
</body>
</html>

</script>
 