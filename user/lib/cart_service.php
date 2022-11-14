<?php
require_once 'db.php';
function getCount_IdUser($conn,$idmember){
	return db_query($conn,"SELECT * from cart where id_user='$idmember'");
}

function getAmount($conn,$id_user,$id_product){
	return db_query($conn,"SELECT * from cart where id_user='$id_user' and id_product='$id_product'");
}
function checkCart($conn,$id_user,$id_product){
	$check= db_query($conn,"SELECT * from cart where id_user='$id_user' and id_product ='$id_product'");
	$num_rows = mysqli_num_rows($check);
	return $num_rows;
}
function getCart_ProductId($conn, $id_user, $id_product) {
	return db_query($conn, "SELECT product.idproduct as 'idproduct', name as 'tensanpham',sale.percent as 'giakm',product.sell as 'giaban',product.image as 'anh',cart.amount as 'soluong',cart.sell as 'thanhtien' FROM cart,product LEFT join sale on product.idproduct = sale.idproduct WHERE cart.id_product= product.idproduct and product.idproduct=$id_product and id_user= $id_user");
}
function getAllCart($conn, $id_user) {
	return db_query($conn, "SELECT product.idproduct as 'idproduct', name as 'tensanpham',sale.percent as 'giakm',product.sell as 'giaban',product.image as 'anh',cart.amount as 'soluong',cart.sell as 'thanhtien' FROM cart, product LEFT join sale on product.idproduct = sale.idproduct WHERE cart.id_product= product.idproduct and id_user=$id_user");
}

function createCart($conn, $id_user, $id_product, $sell) {
	db_query($conn, "INSERT INTO `cart`( `id_user`, `id_product`, `amount`, `sell`) VALUES ($id_user, 
		$id_product,1,$sell)");
}

function updateCart($conn, $id_user, $id_product, $amount,$sell) {
	db_query($conn, "UPDATE `cart` SET `amount`='$amount', sell='$sell' WHERE id_user = '$id_user' and id_product='$id_product' ");
}

function deleteCart($conn, $id_user, $id_product) {
	return db_query($conn, "DELETE FROM cart WHERE id_user = $id_user and id_product =$id_product");
}
function get_TongTien($conn, $id_user){
	return db_query($conn, "SELECT sum(sell) as 'tongtien' FROM cart WHERE id_user = $id_user ");

}

function getCart($conn, $id) {
	return db_single($conn, "SELECT * FROM cat WHERE id = $id");
}

function newsCountOfCart($conn, $id) {
	$result = db_query($conn, "SELECT id  FROM `news` WHERE cat_id=$id
LIMIT 0,1");
	return mysqli_num_rows($result);
}


 ?>