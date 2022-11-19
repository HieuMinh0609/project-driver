<?php 	include '../layout/header.php'; ?>
<div class="container-fluid">
		 
			 
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="../index.php">Home</a>
				<span>/</span>
				<a href="list.php">Quản lý cấu hình hệ thống</a>
				<span>/</span>
				<span>Xóa</span>
			</div>
		
		</div>
 

<?php 
 
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/system_config_service.php");
 

	$conn = db_connect();

	$id = escapeGetParam($conn, "id");
	 
 	
 	


	if(deleteSystemConfig($conn, $id)){
		echo("<br><br><div class=\"container\">
	 	  <div class=\"alert alert-success\">
	   	 <strong>Thành công!</strong> Xóa thành công !.
	  	</div></div>");
	}else{
		echo("<br><br><div class=\"container\">
	 	  <div class=\"alert alert-danger\">
	   	 <strong>Lỗi!</strong> Xóa thất bại!.
	  	</div></div>");	
	}
	 
 	db_close($conn);
 
?>
 