 
<?php include '../includes/FooterHeader/header.php' ?>
<div class="container-fluid">
		<div class="row">
			 
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="../viewhome/HomePage.php">Home</a>
				<span>/</span>
				<a href="billlist.php">Bill</a>
				<span>/</span>
				<span>Bill edit</span>
			</div>
		
		</div>
	</div>
<?php 
	require("../../lib/controls.php");
	require_once("../../lib/db.php");
	require("../../lib/BillService.php");


	$conn = db_connect();

	$id = escapeGetParam($conn, "id");
 
if(isset($_POST["status"])){
	if($_POST["status"] == "Final"){
		updateBill($conn,$id,0);
	}else if($_POST["status"] == "UnFinal"){
		updateBill($conn,$id,1);
	}
 	
 	echo("<br><br><div class=\"container\">
 		<div class=\"alert alert-success\">
    <strong>Success!</strong> Update status done!.
  </div></div>");
 
}
 


	if(isset($_POST["edit"])) {
		updateCat($conn, $id, 
			escapePostParam($conn, "title"), 
			escapePostParam($conn, "description"));
		
		echo("Tin sửa thành công");
	}

	$row = getBill($conn, $id);
?>



<div class="container" style="width:700px">
 <div id="form_register" class="col-md-12 col-sm-12 col-12">
 <form action="" method="post">
 <div class="radio">
				 <?php 
 				
 					if($row["status"]==0){
 					 echo("<label><input type=\"radio\" value=\"Final\" name=\"status\" checked>Final</label>");
                    echo("<label><input type=\"radio\" value=\"UnFinal\" name=\"status\">Unfinal</label>");
 					}else{
 						 echo("<label><input type=\"radio\" value=\"Final\" name=\"status\" >Final</label>");
                   		 echo("<label><input type=\"radio\" value=\"UnFinal\"  name=\"status\" checked>Unfinal</label>");
 					}

 				 ?>	
                                  
 </div>
 				<div class="row">

				 <div class="col-md-2 "  style="float: right">
				    <button class="btn btn-danger">Update</button>
				</div>
			</div>
 </form>      
</div>
 </div>
 </div>
 <?php include '../includes/FooterHeader/footer.php'; ?>