<?php include '../includes/FooterHeader/header.php'; ?>
<div class="container-fluid">
		<div class="row">
			 
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="../viewhome/HomePage.php">Home</a>
				<span>/</span>
				<a href="memberlist.php">Member</a>
				<span>/</span>
				<span>Member delete</span>
			</div>
		
		</div>
	</div>

<?php 
	require_once("../../lib/db.php");
	require("../../lib/MemberService.php");

	$conn = db_connect();

	$id = escapeGetParam($conn, "id");
	 
 	
 	


	if(deleteMember($conn, $id)){
		echo("<br><br><div class=\"container\">
	 	  <div class=\"alert alert-success\">
	   	 <strong>Success!</strong> Delete member done!.
	  	</div></div>");
	}else{
		echo("<br><br><div class=\"container\">
	 	  <div class=\"alert alert-danger\">
	   	 <strong>Wrong!</strong> Delete member  wrong - Check again!.
	  	</div></div>");	
	}
	 
 	db_close($conn);
 
?>
 <?php include '../includes/FooterHeader/footer.php'; ?>