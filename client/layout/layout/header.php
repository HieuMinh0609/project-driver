
<?php 
	require_once ('../../lib/auth.php');

	checkLoggedInWeb();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}
	
 ?>
<div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Driver</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="col-md-6">
					<form class="form-inline my-2 my-lg-0">
						<input class="form-control mr-sm-2" type="search" style="with:100%" placeholder="Tìm kiếm" aria-label="Search">
						<button class="btn btn-secondary  my-2 my-sm-0" type="submit">Tìm kiếm</button>
					</form>
				</div>
				<div class="col-md-4">
					<ul class="navbar-nav mr-auto item-menu"  >
						<li class="nav-item ">
							<a class="nav-link link-menu" href="shareWithMe.php">Driver chia sẻ với tôi<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item active">
							<a class="nav-link link-menu" href="index.php">Driver của tôi <span class="sr-only">(current)</span></a>
						</li>
					</ul>
				</div>
				<div class="col-md-2">
						<!-- Default dropleft button -->
						<div class="btn-group dropleft" style="float:right">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php
								require_once ('../../lib/auth.php');
								require_once ('../../lib/db.php');
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

		<div class="container-fluid">
			 
			 <!-- Button trigger modal -->
			 <button type="button" class="btn btn-secondary mt-2" data-toggle="modal" data-target="#uploadFile">
					 Tải tệp tin lên
			 </button>
 
			 <!-- Button trigger modal -->
			 <button type="button" class="btn btn-secondary mt-2" data-toggle="modal" data-target="#createFolder">
					 Tạo thư mục
			 </button>
 
		</div>
</div>
 

