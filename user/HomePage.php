<?php include 'includes/header.php'; ?>
<script type="text/javascript" src="content/jquery-3.4.1.min.js"></script>
	 <link rel="stylesheet"  type="text/css" href="content/bootstrap-3.1.1-dist/css/bootstrap.min.css">
	 <script type="text/javascript" src="content/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="content/style.css">

	  <link rel="stylesheet" type="text/css" href="content/file.css">
	  <script  language="JavaScript"  type="text/javascript" src="content/file.js"></script>
<div class="container-fluid">
		<div class="row">
			 
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="#">Home</a>
				<span>/</span>
				<span>Product</span>
			</div>
		
		</div>
	</div>
	<div class="container">
		
		<form>
			<div class="row">
				<div class="col-md-10 col-sm-10 col-xs-10">
					<div class="input_search_area">
						<input  class="input_search" type="text"  placeholder="Code Invoice" >
						<span class="focus-input100"></span>
						<div class="symbol-input100">
						 
							<i class="glyphicon glyphicon-search"></i>
						 
						</div>
						
					</div>
					
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
						<button type="button" class="btn_sreach btn btn-success">Search</button>
					</div>
		</div>
		<div id="button_select" class="row">
				<button class="btn btn_primary_button btn_select" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
				<button class="btn btn_primary_button btn_select"  title="Edit" ><i class="glyphicon glyphicon-pencil"></i></button>
				<button class="btn btn_primary_button btn_select"  title="Add"><i class="gglyphicon glyphicon-plus"></i></button>
				 
				
		</div>
		<div class="row">
			<table class="table table_backcolor table-bordered">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">First</th>
			      <th scope="col">Last</th>
			      <th scope="col">Handle</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">1</th>
			      <td>Mark</td>
			      <td>Otto</td>
			      <td>@mdo</td>
			    </tr>
			    <tr>
			      <th scope="row">2</th>
			      <td>Jacob</td>
			      <td>Thornton</td>
			      <td>@fat</td>
			    </tr>
			    <tr>
			      <th scope="row">3</th>
			      <td>Larry the Bird</td>
			      <td>@twitter</td>
			      <td>@mdoipp</td>
			    </tr>
			  </tbody>
			</table>
					<div></div>	
		</div>
		</form>
		
	</div>
<?php include 'includes/footer.php'; ?>