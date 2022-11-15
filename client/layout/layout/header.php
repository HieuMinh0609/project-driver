
<?php 
	include '../../lib/auth.php';

	checkLoggedInWeb();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}
	
 ?>
<div  >
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Driver</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	 	<div class="col-md-8">
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" size="100" placeholder="Tìm kiếm" aria-label="Search">
				<button class="btn btn-secondary  my-2 my-sm-0" type="submit">Tìm kiếm</button>
			</form>
		</div>
		<div class="col-md-4">
				<!-- Default dropleft button -->
				<div class="btn-group dropleft" style="float:right">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php
						require_once '../../lib/auth.php';
						require_once '../../lib/db.php';
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
<script type="text/javascript">
	var username = '<?php echo $username ?>'
	
	if(username =='') {
		$('.name-dangxuat').hide();
		$('.giohang').hide();
		$('.feedback').hide();
	} else {
		$('.dangnhap').hide();
	}
   		
</script>


