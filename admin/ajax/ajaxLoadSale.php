<?php 
 
  require("../../lib/controls.php");
  require_once("../../lib/db.php");
  require("../../lib/SaleService.php");
   require("../../lib/ProductService.php");

   $conn = db_connect();
   $id = escapePostParam($conn, "id");
     $result =getSingleProduct($conn,$id);   
   db_close($conn);


 
die (json_encode($result));
?>