<?php include '../includes/FooterHeader/header.php'; ?>
<div class="container-fluid">
		<div class="row">
			 
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="../viewhome/HomePage.php">Home</a>
				<span>/</span>
				<a href="salelist.php">Sale</a>
				<span>/</span>
				<span>Delete</span>
			</div>
		
		</div>
	</div>

<?php 
	require_once("../../lib/db.php");
	require("../../lib/SaleService.php");

	$conn = db_connect();

	$id = escapeGetParam($conn, "id");
	 
 	
 	


	if(deleteSale($conn, $id)){
		echo("<br><br><div class=\"container\">
	 	  <div class=\"alert alert-success\">
	   	 <strong>Success!</strong> Delete sale done!.
	  	</div></div>");
	}else{
		echo("<br><br><div class=\"container\">
	 	  <div class=\"alert alert-danger\">
	   	 <strong>Wrong!</strong> Delete sale  wrong - Check again!.
	  	</div></div>");	
	}
	 
 	db_close($conn);
 
?>
 <?php include '../includes/FooterHeader/footer.php'; ?>