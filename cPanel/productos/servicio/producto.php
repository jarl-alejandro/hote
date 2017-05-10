<?php 
include '../../../bd/db.php';

$codigo = $_GET["codigo"];

$producto = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$codigo'");
$row = $producto->fetch();

$json = json_encode($row);
echo $json;