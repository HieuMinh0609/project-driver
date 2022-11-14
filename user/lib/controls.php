<?php 
	require_once 'db.php';
	function Timkiem_SanPham($conn, $name, $start, $limit){
		return db_query($conn, "SELECT  product.idproduct as 'idproduct', product.name, product.information, product.sell, product.typeid, product.image, product.status, sale.percent as 'promotion' FROM product LEFT JOIN sale ON product.idproduct = sale.idproduct  where name LIKE N'%$name%' and status ='0' LIMIT $start,$limit");
	}
	function Total_TimkiemSanPham($conn, $name){
		return db_query($conn, "SELECT count(idproduct) as total FROM product where name LIKE '%$name%' and status ='
			0'");
	}
	function Product_Doan_Hot($conn) {
		return db_query($conn, "SELECT product.idproduct as 'idproduct', product.name, product.information, product.sell, product.typeid, product.image, product.status, sale.percent as 'promotion' FROM product LEFT JOIN sale ON product.idproduct = sale.idproduct WHERE typeid='1' and status ='0' LIMIT 0, 4");
	}
	function Product_Doan_Fast($conn) {
		return db_query($conn, "SELECT product.idproduct as 'idproduct', product.name, product.information, product.sell, product.typeid, product.image, product.status, sale.percent as 'promotion' FROM product LEFT JOIN sale ON product.idproduct = sale.idproduct WHERE typeid='2' and status ='0' LIMIT 0, 4");
	}
	function Product_Douong($conn) {
		return db_query($conn, "SELECT product.idproduct as 'idproduct', product.name, product.information, product.sell, product.typeid, product.image, product.status, sale.percent as 'promotion' FROM product LEFT JOIN sale ON product.idproduct = sale.idproduct WHERE typeid='3' and status ='0' LIMIT 0, 4");
	}
	function Total_Product_Hot($conn){
		return db_query($conn, "SELECT count(idproduct) as total FROM product where typeid='1' and status ='0'");
	}
	function Total_Product_Fast($conn){
		return db_query($conn, "SELECT count(idproduct) as total FROM product where typeid='2' and status ='0'");
	}
	function Total_Product_Uong($conn){
		return db_query($conn, "SELECT count(idproduct) as total FROM product where typeid='3' and status ='0'");
	}
	function Product_Doan_Hot_Full($conn,$start,$limit) {
		return db_query($conn, "SELECT product.idproduct as 'idproduct', product.name, product.information, product.sell, product.typeid, product.image, product.status, sale.percent as 'promotion' FROM product LEFT JOIN sale ON product.idproduct = sale.idproduct WHERE typeid='1' and status ='0' LIMIT $start,$limit");
	}
	function Product_Doan_Fast_Full($conn,$start,$limit) {
		return db_query($conn, "SELECT product.idproduct as 'idproduct', product.name, product.information, product.sell, product.typeid, product.image, product.status, sale.percent as 'promotion' FROM product LEFT JOIN sale ON product.idproduct = sale.idproduct WHERE typeid='2' and status ='0' LIMIT $start,$limit");
	}
	
	function Product_Douong_Full($conn,$start,$limit) {
		return db_query($conn, "SELECT product.idproduct as 'idproduct', product.name, product.information, product.sell, product.typeid, product.image, product.status, sale.percent as 'promotion' FROM product LEFT JOIN sale ON product.idproduct = sale.idproduct WHERE typeid='3' and status ='0' LIMIT $start,$limit");
	}
	function Add_Cart($conn,$start,$limit) {
		return db_query($conn, "SELECT  * FROM product where typeid='3' and status ='1' LIMIT $start,$limit");
	}
	function GetProduct_Id($conn, $id_product){
		return db_query($conn,"SELECT product.idproduct , name, information, sell, sale.percent as 'promotion', image, AVG(rate) as 'avg_rate' from product LEFT join sale on product.idproduct = sale.idproduct LEFT join comment on product.idproduct = comment.idproduct where product.idproduct = $id_product");
	}
	function Filter_ProductPrice($conn, $min, $max){
		return db_query($conn, "SELECT * FROM  product where sell>= $min and sell <=$max");
	}
 ?>


