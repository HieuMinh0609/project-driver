
<?php 
 	include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");

	checkLoggedInAdmin();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}

	$name_search = $_GET['parent_id'] ?? null;

	
 ?>

 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Driver Admin</title>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../template/admin.css"></link>


</head>
<body>

<div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Driver Admin</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="col-md-6">
				 
				</div>
				<div class="col-md-4">
					<ul class="navbar-nav mr-auto item-menu"  >
 
						<li class="nav-item active driverMe">
							<a class="nav-link link-menu" href='<?php echo "/project-driver/admin/layout/user/list.php" ?>'>Quản lý người dùng	</a>
						</li>
						<li class="nav-item active driverMe">
							<a class="nav-link link-menu" href='<?php echo "/project-driver/admin/layout/fileOrFolder/list.php" ?>'>Quản lý tài liệu</a>
						</li>
						<li class="nav-item active driverMe">
							<a class="nav-link link-menu" href='<?php echo "/project-driver/admin/layout/configSystem/list.php" ?>'>Quản lý cấu hình</a>
						</li>
				 
					</ul>
				</div>
				<div class="col-md-2">
						<!-- Default dropleft button -->
						<div class="btn-group dropleft" style="float:right">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php
								include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
				 
								include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
								$username = getLoggedInUser();
								echo $username;
							?>
						</button>
						<div class="dropdown-menu">
							<a href="?logout=logout" class="dangxuat dropdown-item " name="logout">Logout</a>
						</div>
						</div>


				</div>
				


			</div>
		</nav>

		 
</div>
 

</body>
</html>