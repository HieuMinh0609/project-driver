<?php include '../includes/FooterHeader/header.php'; ?>
<div class="container-fluid">
		<div class="row">
			 
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="../viewhome/HomePage.php">Home</a>
				<span>/</span>
				<span>Feedback</span>
			</div>
		
		</div>
	</div>
<div class="container">
	<form action="feedbackShow.php" method="get">
			<div class="row">
				<div class="col-md-10 col-sm-10 col-xs-10">
					<div class="input_search_area">
						<input id="input_search_btn" class="input_search" type="text" name="nameCus" placeholder="Login Name" >
						<span class="focus-input100"></span>
						<div class="symbol-input100">					 
							<i class="glyphicon glyphicon-search"></i>
						</div>
						
					</div>
					
				</div>
				<div class="col-md-2 col-sm-2 col-xs-2">
						<button id="btn_search" type="submit" class="btn_sreach btn btn-success">Search</button>
					</div>
		</div>
	</form>

</div>
<div class="container">
	<form action="feedbackShow.php" method="post">
	<button name="btndanhdau" style="submit" class="btn btn-warning">Đánh dấu là đã đọc tất cả</button>
</form>
</div>
<br>
<div class="container">
<?php 
	require("../../lib/controls.php");
 

if (isset($_POST['btndanhdau']))   {
    $conn = db_connect();
	updateFeedback($conn);	
	db_close($conn);
}


?>
</div>
<?php 

  

	if (isset($_GET['page']))   {
    	$current_page = $_GET['page'];
	}else{
		$current_page =1;
	}
	$nameCus="";
	if (isset($_GET['nameCus'])){
		$nameCus=$_GET['nameCus'];

    	  if($_GET['nameCus']!==""){
    	  	$arr = array("m.namelogin"=>$_GET['nameCus']);
    	  }else{
    	  	 $arr = array();
    	  }
	}else{
		 $arr = array();
	}
	$limit =5;
	$offer =($current_page - 1)*$limit;;
	
	

	$conn = db_connect();
	$result = findPropertyFeedback($conn,$arr,$offer,$limit);

	printTable($result, 
		["createdate" => "Thời Gian", 
		"namelogin" => "Tên Đăng Nhập",
		"content" => "Nội Dung",
		"status"=>"Đã đọc/Chưa đọc"
	],
		"","","","");

	db_close($conn);
?>

 <div class="example">
        <div class="container">
            <div class="row">
                <ul class="pager">
		
                    <li><a id="Previous_page" href="javascript:prevPage()">Previous</a></li>
                    <li><span id="page_value"><?php echo $current_page ?></span></li>
                    <li><a id="Next_page" href="javascript:nextPage()">Next</a></li>
                </ul>
            </div>
        </div>
    </div>

<script type="text/javascript">
   	var current_page = <?php echo $current_page ?>
   	
   
   	$(function(){
   		$('#input_search_btn').val("<?php echo  $nameCus ?>");
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
        if("<?php echo  $nameCus ?>"==""){
        	window.location="feedbackShow.php?page="+current_page;
        }else{

        	window.location="feedbackShow.php?page="+current_page+"&nameCus="+"<?php echo  $nameCus ?>";
        } 
    }
    $('#page_value').text(current_page);
}

function nextPage()
{  

        current_page++;
        changePage(current_page); 

        if("<?php echo  $nameCus ?>"==""){
        	window.location="feedbackShow.php?page="+current_page;
        }else{
        	 
        	window.location="feedbackShow.php?page="+current_page+"&nameCus="+"<?php echo  $nameCus ?>";
        }

         
        $('#page_value').text(current_page);
    
}
</script>
<?php include '../includes/FooterHeader/footer.php'; ?>