
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Driver</title>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../template/client.css"></link>
</head>
<body>
	
<?php 
	include_once ('../../../lib/auth.php');

	checkLoggedInWeb();
	
	if (isset($_GET['logout']))   {
        doLogout();
	}
	
 ?>
<?php 
    require('../../../lib/db.php');
    require ('../../../lib/controls.php');
    require ('../../../lib/service/store_file_folder_service.php');
?>

<?php 
 
    if(isset($_POST["UPDATES"])){

          $conn = db_connect();
            update($conn,$idmember, 
                escapePostParam($conn, "parent_id"), 
                escapePostParam($conn,"id"));     
            db_close($conn);
        echo("<br><br><div class=\"container\">
            <div class=\"alert alert-success\">
            <strong>Success!</strong> Update status done!.
            </div></div>");
    
    }
  
?>
    <div class="pt-5">
        <div class="container" >
            <div class="center">

              

                
                <?php 
                    
                    $conn = db_connect();

                        $id = escapeGetParam($conn, "id");

                        $item = findById($conn, $id);
                        $listFolder = findFolderOrFileByProperty($conn, '', 'FOLDER', 0, 9999999);

                    db_close($conn);
                
                ?>

                <form action="" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><b>Tên</b> </label>
                            <input type="text" require class="form-control" readonly name="name" value=" <?php echo $item["name"] ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <input type="hidden" require class="form-control" name="id"  value=" <?php echo $item["id"] ?>" aria-describedby="emailHelp">
                        
                        <div>
                            <label for="exampleInputEmail1"><b>Thư mục cha</b> </label>
                            <select class="form-control " name="parent_id">
                                <option  value="">-Thư mục cha-</option> 
                                <?php while ($item = mysqli_fetch_array($listFolder)) {
                                ?>	
                                  
                                    <?php 
                                        if ($item["id"] == $id) {
                
                                            echo("<option selected value=".$item["id"].">".$item["name"]."</option>");
                                        }
                                    ?>
                                    <?php 
                                        if ($item["id"] != $id) {
                                            echo("<option  value=".$item["id"].">".$item["name"]."</option>");
                                        }
                                    ?>
                                 
                                <?php } ?>	  
                            </select>
                         </div>
                        <button type="submit" name="UPDATES" class="btn btn-primary mt-5" onclick="return confirm('Bạn có chắc chắn muốn cập nhật ?')" h>Cập nhật </button>
                        
                </form>
                
            </div>
           
            
          
        </div>
        <button class="btn btn-secondary ">
            <a style="color: white" href="/project-driver/client/layout/index.php"> << Quay lại</a>
        </button>
    </div>
 
</body>
</html>