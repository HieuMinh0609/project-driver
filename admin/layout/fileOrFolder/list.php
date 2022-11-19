 
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


<?php 
 
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
 include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/store_file_folder_service.php");
 
?>

<?php 

	include '../layout/header.php';

?>

<div class="container-fluid mt-2">
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="../index.php">Home</a>
				<span>/</span>
				<span>Quản lý tài liệu</span>
			</div>
	</div>
 
<div class="container mt-3">
	<form action="list.php" method="get">
			<div class="row">
				<div class="col-md-10 col-sm-10 col-xs-10">
					<div class="input_search_area">
						<input id="input_search_btn"  class="form-control" type="text" name="name" placeholder="Tên file hoặc folder" >
						<span class="focus-input100"></span>
						<div class="symbol-input100">					 
							<i class="glyphicon glyphicon-search"></i>
						</div>
						
					</div>
					
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
						<button id="btn_search" type="submit"  class="btn btn-secondary">Tìm kiếm</button>
				</div>
		</div>
	</form>
 
	<br>
</div>


<?php 
	 
	if (isset($_GET['page']))   {
    	$current_page = $_GET['page'];
	}else{
		$current_page =1;
	}
	$name="";

	if (isset($_GET['name'])){
		$name=$_GET['name'];
	}

	$limit =5;
	$offer =($current_page - 1)*$limit;;
	
	

	$conn = db_connect();
	$result = findFolderOrFileByPropertyForAdmin($conn,$name,$offer,$limit);

	printTable($result, 
		["id" => "ID", 
		"name" => "Tên file or Folder",
		"username" => "Tên tài khoản",
		"parent_id"=> "ID cấp trên",
		"type_store" => "Loại tài khoản"
	],
		"","id","",'showFile.php',null,"","");

	db_close($conn);
?>

 <div class="example">
        <div class="container">
    
			<nav aria-label="Page navigation example">
			<ul class="pagination">
				<li class="page-item"><a class="page-link" id="Previous_page" href="javascript:prevPage()"><<</a></li>
				<li class="page-item"><span  class="page-link"  id="page_value"><?php echo $current_page ?></span></li>
				<li class="page-item"><a class="page-link"  href="javascript:nextPage()">>></a></li>
			</ul>
			</nav>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
   	var current_page = <?php echo $current_page ?>
   	
   
   	$(function() {
   		$('#input_search_btn').val("<?php echo  $name ?>");
   	});
   
  function changePage(page)
{
    var btn_next = document.getElementById("Next_page");
    var btn_prev = document.getElementById("Previous_page");
   
 
    // Validate page
    if (page < 1) page = 1;
    

    if (page == 1) {
        btn_prev.style.visibility = "hidden";
    } else {
        btn_prev.style.visibility = "visible";
    }   
}

 function prevPage()
{

    if (current_page > 1) {
        current_page--;
        changePage(current_page);
        if("<?php echo  $name ?>"==""){
        	window.location="list.php?page="+current_page;
        }else{

        	window.location="list.php?page="+current_page+"&name="+"<?php echo  $name ?>";
        } 
    }
    $('#page_value').text(current_page);
}

function nextPage()
{  

        current_page++;
        changePage(current_page); 

        if("<?php echo  $name ?>"==""){
        	window.location="list.php?page="+current_page;
        }else{
        	 
        	window.location="list.php?page="+current_page+"&name="+"<?php echo  $name ?>";
        }

         
        $('#page_value').text(current_page);
    
}
</script>
 