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
        include_once ('../../lib/service/store_file_folder_service.php');

		$limit = 999999;
		$name_search = $_GET['name'] ?? null;

		$con = db_connect();
	 
			$countFolder = countFolderOrFileByProperty($con, $name_search, 'FOLDER');

			$rowFolder = mysqli_fetch_assoc($countFolder);
			$total_record_folder = $rowFolder['total'];

			$current_page_folder = isset($_GET['page']) ? $_GET['page'] : 1;
			$total_page_folder = ceil($current_page_folder / $limit);

			if ($current_page_folder > $total_page_folder) $current_page_folder = $total_page_folder;
			else if ($current_page_folder < 1)  $current_page_folder = 1;
			

			$startPageFolder = ($current_page_folder - 1) * $limit;

			$listFolder = findFolderOrFileByProperty($con,$name_search, 'FOLDER',$startPageFolder, $limit);

	
			$countFile = countFolderOrFileByProperty($con, $name_search, 'FILE');

			$rowFile = mysqli_fetch_assoc($countFile);
			$total_record_file = $rowFile['total'];

			$current_page_file = isset($_GET['page']) ? $_GET['page'] : 1;
			$total_page_file = ceil($current_page_file / $limit);

			if ($current_page_file > $total_page_file) $current_page_file = $total_page_file;
			else if ($current_page_file < 1)  $current_page_file = 1;
			

			$startPageFile = ($current_page_file - 1) * $limit;

			$listFile= findFolderOrFileByProperty($con,$name_search, 'FILE',$startPageFile, $limit);

		db_close($con);
 
		echo "<script>  	
				 	$('.input_timkiem').val('$name_search');
				 </script>";			
 
	?>

<div class="pt-5">
    <div class="container-fluid" >
		<div class="row">
			<div class="col-md-12 mb-2"><b>Danh sách tệp tin</b></div>
			<?php while ($item = mysqli_fetch_array($listFolder)) {
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

		<div class="row mt-5">
			<div class="col-md-12 mb-2"><b>Danh sách tài liệu</b></div>
			<?php while ($item = mysqli_fetch_array($listFile)) {
				?>	
				 	<div class="col-lg-2 col-md-4">
						<div class="card">
							<div class="card-header" title="<?php echo $item['name'] ?>">
								
								
								<div class="row">
									
									<div class="col-md-8 ">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-ruled-fill" viewBox="0 0 16 16">
											<path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1H6v2h7v1H6v2H5v-2H3v-1h2v-2H3V9z"/>
										</svg>
										<?php echo substr($item['name'], 0, 20) ?>
									</div>
									
									<div  class="col-md-2 item-type-file">
										<b><?php 
											$name_file = $item['name'];
											$arry = (explode(".",$name_file));
											$type_file = "";
									
											if (count($arry) == 2) $type_file = '.' . $arry[count($arry) -1 ];
											echo $type_file;
										?></b>
									</div>
									<div class="col-md-2" >

										<i style="float:right" type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										 
										</i>
										<div class="dropdown-menu">
											 <a class=" dropdown-item " href="#">Try cập</a>
											 <a class=" dropdown-item " onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" href="./storeFileFolder/delete.php?id=<?php echo $item["id"] ?>"  id-item="<?php echo  $item["id"] ?>" href="#">Xóa</a>
											 <a class=" dropdown-item "  href="./storeFileFolder/edit.php?id=<?php echo $item["id"] ?>"  href="#">Sửa</a>
											 <a class=" dropdown-item " href="./storeFileFolder/shareFileFolder.php?id=<?php echo $item["id"] ?>">Chia sẻ</a>
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
 