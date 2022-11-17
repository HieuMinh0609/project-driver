<?php 
	include_once ('../../lib/auth.php');

	checkLoggedInWeb();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}
	
 ?>

<?php 
	
		include_once ('../../lib/db.php');
		include_once ('../../lib/controls.php');
		include_once ('../../lib/auth.php');
        include_once ('../../lib/service/share_service.php');


		$name_search = $_GET['name'] ?? null;

		$con = db_connect();
            startSession();
            $user_id = $_SESSION["id"];

			$list = findShareByProperty($con, $name_search, $user_id, 0, 99999999);
            
		db_close($con);
 
		echo "<script>  	
				 	$('.input_timkiem').val('$name_search');
				 </script>";			
 
	?>

<div class="pt-5">
    <div class="container-fluid" >
		<div class="row">
			<div class="col-md-12 mb-2"><b>Danh sách tệp tin chia sẻ</b></div>

			<?php while ($item = mysqli_fetch_array($list)) {
			?>	
					
				
				 	<div class="col-lg-2 col-md-4">
						<div class="card">
							<div class="card-header" title="<?php echo $item['name'] ?>">

							<div class="row">
								<div class="col-md-10">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-fill" viewBox="0 0 16 16">
										<path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
									</svg>
									
									<?php echo substr($item['name'], 0, 20) ?>
								</div>
								<div class="col-md-2" >
								
										<i style="float:right" type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										 
										</i>
										<div class="dropdown-menu">
										<a class=" dropdown-item " href="#">Try cập</a>
											 <a class=" dropdown-item " onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" href="./storeFileFolder/delete.php?id=<?php echo $item["id"] ?>"  id-item="<?php echo  $item["id"] ?>" href="#">Xóa</a>
											 <a class=" dropdown-item "  href="./storeFileFolder/edit.php?id=<?php echo $item["id"] ?>"  href="#">Sửa</a>
											 <a class=" dropdown-item " href="#">Chia sẻ</a>
										</div>
								 
								</div>
							</div>
							</div>
						</div>
					</div>

				<?php } ?>		
		</div>
 
       
    </div>
</div>
 