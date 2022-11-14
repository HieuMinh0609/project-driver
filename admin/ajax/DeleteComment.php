<?php 
 
  
  require_once("../../lib/db.php");
  require("../../lib/CommentService.php");
   
   $conn = db_connect();
   $id = escapePostParam($conn, "id");
   $result=deleteComment($conn,$id);
      db_close($conn);
 
   die (json_encode($result));
  		
 ?>