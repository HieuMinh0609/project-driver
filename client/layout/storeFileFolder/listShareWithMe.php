<?php 

	include_once ('../../lib/db.php');
	include_once ('../../lib/controls.php');
	include_once ('../../lib/auth.php');
	include_once ('../../lib/service/share_service.php');
	include_once ('../../lib/service/store_file_folder_service.php');


	
	checkLoggedInWeb();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}
	
 ?>

<?php 
	 startSession();
	 function isIdParentInCache($parent_id) {
	
			if (isset($_SESSION["permisstionFiles"])) {

				if(in_array( $parent_id , $_SESSION["permisstionFiles"]) ) {
					 return true;
				} else return false;

			} else return false;
	 }
	
 ?>

 <?php
	 if(isset($_POST["CONFIRM"])) {
	
	
	  $conn = db_connect();
	  		$parent_id = $_GET['parent_id'] ?? null;
	  		$password = escapePostParam($conn, "password");
			$item = isCorrectPasswordShare($conn, $parent_id, $password );
 
			if(empty($item)) {
					echo("<br><br><div class=\"container\">
					<div class=\"alert alert-warning\">
					<strong>Lỗi!</strong> Sai mật khẩu!.
					</div></div>");
			} else {

				if (!isIdParentInCache($parent_id)) {
					$items = $_SESSION["permisstionFiles"] ?? array();
					$items[] = $parent_id ;
					$_SESSION["permisstionFiles"] = $items;
				}
 
			}
		  
		db_close($conn);
  }

 ?>



 

<?php 
	
		

		$name_search = $_GET['name'] ?? null;
		$name_parrent = "";

		$parent_id = $_GET['parent_id'] ?? null;
		$con = db_connect();
			$type_permision = "ALL";
			$isIdParentInCache = isIdParentInCache($parent_id);	

			if (!empty($parent_id)) {
				$file_folder = findById($con, $parent_id);
				// $name_parrent = "Tệp tin cha: ".$file_folder['name'];

				if (!$isIdParentInCache) {

					$item_share = findShareById($con, $parent_id);
					
					if (!empty($item_share)) {
						
						$type_permision = $item_share['type_share'];
					}
					 
				}
			}

			
			startSession();
			$user_id = $_SESSION["id"];

			$list = findShareByProperty($con, $name_search, $user_id, $parent_id, 0, 99999999);
			 
		db_close($con);
 
		echo "<script>  	
				 	$('.input_timkiem').val('$name_search');
				 </script>";			
 
	?>
<style>
	.shareWithMe {
		font-weight: bold;
		
	}

	.shareWithMeItem {
		color: black !important;
	}

	.driverMe {
		font-weight: normal;
	}
</style>

<div class="pt-5">
    <div class="container-fluid" >
		<div class="row">

			<?php if($type_permision == 'USER_PASSWORD' or $type_permision == 'ALL_PASSWORD') { ?>
			<div class="container">
					<form action="" method="POST">
						    <label for=""><b>Xác nhận mật khẩu</b></label>
							<input type="text" name="password" class="form-control">
							<button name="CONFIRM" class="btn btn-secondary mt-2">Xác nhận</button>
					</form>		
				</div>
					
			<?php } ?>
			<?php if($type_permision == 'ALL' or $type_permision == 'USER'   or $isIdParentInCache == true) { ?>
				<div class="col-md-12 mb-2"><b><?php 
					
					if (!empty($file_folder)) {
						echo '<a href="shareWithMe.php?parent_id='.$file_folder['parent_id'].'"><h3>Thư mục cha : ' .$file_folder['name'].'</a></h3>';
					}

				?></b></div>
				<div class="col-md-12 mb-2"><b>Danh sách tệp tin chia sẻ</b></div>
				
				<?php while ($item = mysqli_fetch_array($list)) {
				?>	
						<div class="col-lg-2 col-md-4">
							<div class="card">
								<div class="card-header" title="<?php echo $item['name'] ?>">

								<div class="row">
									<div class="col-md-10">
										<?php 
											if ($item["type_store"] == 'FOLDER') {
												echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-fill" viewBox="0 0 16 16">
														<path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
												</svg>';
											} else {
												echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-ruled-fill" viewBox="0 0 16 16">
															<path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1H6v2h7v1H6v2H5v-2H3v-1h2v-2H3V9z"/>
													</svg>';

											}
										?>
										
										
										<?php echo substr($item['name'], 0, 20) ?>
									</div>
									<div class="col-md-2" >
									
											<i style="float:right" type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											
											</i>
											<div class="dropdown-menu">
											<?php 
														if ($item["type_store"] == 'FILE') {
															echo '<a class=" dropdown-item " href="./storeFileFolder/showFile.php?id='.$item["id"].' ">Try cập</a>';
														} else {
															echo '<a class=" dropdown-item " href="./shareWithMe.php?parent_id='.$item["id"].' ">Try cập</a>';
														}
														
												?>
											</div>
									
									</div>
								</div>
								</div>
							</div>
						</div>

					<?php } ?>		
				<?php } ?>
		</div>
 
    </div>
</div>
 