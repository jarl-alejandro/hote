<?php 
include '../../../bd/db.php';

$codigo = $_GET["codigo"];

$proveedor = $pdo->query("SELECT * FROM hotel_proveedor WHERE codigo_proveedor='$codigo'");
$row = $proveedor->fetch();

$json = json_encode($row);
echo $json;