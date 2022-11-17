<?php
 
    function createSharePermission($conn, $share_id , $user_id) {
        db_query_share_return_SharePermission($conn, "INSERT INTO `share_permission`(`share_id`, `user_id`) 
        VALUES ('$share_id', '$user_id')");
    }

    function db_query_share_return_SharePermission($conn, $query) {
        $result1 = mysqli_query($conn, $query);
        return $result1;
    }
?>