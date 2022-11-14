<?php
require_once 'db.php';

function getAllNews($conn, $cat) {
	$condition = ($cat == null || $cat == "") ? "1" : "cat_id = $cat";
	
	return db_query($conn, 
		"SELECT n.*, c.title as cat_title 
		FROM news n INNER JOIN cat c  
			ON n.cat_id = c.id
		WHERE $condition");
}

function createNews($conn, $title, $summary, $content, $cat_id) {
	db_query($conn, "todo");
}

function updateNews($conn, $id, $title, $summary, $content) {
	db_query($conn, "todo");
}

function deleteNews($conn, $id) {
	return db_query($conn, "DELETE FROM news WHERE id = $id");
}


function getNews($conn, $id) {
	return db_single($conn, "SELECT * FROM news WHERE id = $id");
}
 ?>