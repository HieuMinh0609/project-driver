<?php include '../includes/FooterHeader/header.php'?>
<div class="container-fluid">
		<div class="row">
			 
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="../viewhome/HomePage.php">Home</a>
				<span>/</span>
				<a href="billlist.php">Bill</a>
				<span>/</span>
				<span>Bill Delete</span>
			</div>
		
		</div>
	</div>

<?php 
	require_once("../../lib/db.php");
	require("../../lib/BillService.php");

	$conn = db_connect();

	$id = escapeGetParam($conn, "id");
	 
 	
 	


	if(deleteBill($conn, $id)){
		echo("<br><br><div class=\"container\">
	 	  <div class=\"alert alert-success\">
	   	 <strong>Success!</strong> Delete Bill done!.
	  	</div></div>");
	}else{
		echo("<br><br><div class=\"container\">
	 	  <div class=\"alert alert-danger\">
	   	 <strong>Wrong!</strong> Delete Bill  wrong - Check detail bill and must be null all .
	  	</div></div>");	
	}
	 
 	db_close($conn);
 
?>
 <?php include '../includes/FooterHeader/footer.php'; ?>