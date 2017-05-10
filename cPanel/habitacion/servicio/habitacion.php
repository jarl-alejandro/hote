<?php 
include '../../../bd/db.php';

$codigo = $_GET["codigo"];

$producto = $pdo->query("SELECT * FROM hotel_habitacion WHERE codigo_habitacion='$codigo'");
$row = $producto->fetch();

$json = json_encode($row);
echo $json;