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
		 
			
			$con =db_connect();
			if(isset($_POST['submit_timkiem'])) {
				$input_timkiem = $_POST['input_timkiem'];
				$result_tksp = Total_TimkiemSanPham($con, $input_timkiem);
				$row_tksp = mysqli_fetch_assoc($result_tksp);
				$total_records_tksp = $row_tksp['total'];
				echo $total_records_tksp;

				if($input_timkiem != '') {
					
					if($total_records_tksp != 0) {
						echo "<script>  	
					 		window.location.href = 'index.php?name=$input_timkiem';
					 	</script>";
					 	
					}
					else {
						echo "<script>  	
					 	window.location.href = 'layout.php';
					 </script>";
					 
					}

					
				} else {
					echo "<script>  	
					 	window.location.href = 'layout.php';
					 </script>";
					 
				}		
				
			}
		 ?>
		<div class="container-fluid">
			<button class="btn btn-secondary mt-2"><a style="color: white" href="#">Tải tệp tin lên</a></button>

			<button class="btn btn-secondary mt-2"><a style="color: white" href="#">Tạo thư mục</a> </button>

		</div>
		<?php include_once('../layout/storeFileFolder/list.php') ?>

		
	</div>
 
</body>
</html>