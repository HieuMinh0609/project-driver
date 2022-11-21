<?php 
	include_once ('../../lib/auth.php');

	checkLoggedInWeb();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}
	
 ?>

<?php 
	
		include_once ('../../lib/db.php');
 
		include_once ('../../lib/auth.php');
        include_once ('../../lib/service/store_file_folder_service.php');

		$limit = 999999;
		$name_search = $_GET['name'] ?? null; // lấy thông tin tìm kiếm  name  từ url
		$parent_id = $_GET['parent_id'] ?? null;

		$con = db_connect();


			if (!empty($parent_id)) {
				$file_folder = findById($con, $parent_id); // lấy thông tin folder parent_id nếu dó
 
			}
			$listFolder = findFolderOrFileByProperty($con,$name_search, $parent_id, 'FOLDER',0, 99999); //lấy danh sách folder
			$listFile= findFolderOrFileByProperty($con,$name_search, $parent_id, 'FILE',0, 99999); //lấy danh sách file

		db_close($con);
 
		echo "<script>  	
				 	$('.input_timkiem').val('$name_search');
				 </script>";			
 
	?>

<div class="pt-5">
    <div class="container-fluid" >
		<div class="row">

			<div class="col-md-12 mb-2"><b><?php 
					
					if (!empty($file_folder)) {
						echo '<a href="index.php?parent_id='.$file_folder['parent_id'].'"><h3>Thư mục cha : ' .$file_folder['name'].'</a></h3>';
					}

			?></b></div>

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
											<?php 
													if ($item["type_store"] == 'FILE') {
														echo '<a class=" dropdown-item " href="./storeFileFolder/showFile.php?id='.$item["id"].' ">Try cập</a>';
													} else {
														echo '<a class=" dropdown-item " href="./index.php?parent_id='.$item["id"].' ">Try cập</a>';
													}
													
											?>
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

		<div class="row mt-5">
		
			<div class="col-md-12 mb-2"><b>Danh sách tài liệu</b></div>
			<?php while ($item = mysqli_fetch_array($listFile)) { //hiển thị danh sách
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
											$name_file = $item['url'];
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
											<?php if ($item["type_store"] == 'FILE') {?>
														<a class=" dropdown-item " href="./storeFileFolder/showFile.php?id=<?php echo $item["id"]; ?>">Try cập</a>
											<?php		} else { ?>
														<a class=" dropdown-item " href="./index.php?id=<?php echo $item["id"]; ?>">Try cập</a>
											<?php	} ?>
													
											
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
 