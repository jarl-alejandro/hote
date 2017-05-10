<?php 
include '../../../bd/db.php';

$codigo = $_GET["codigo"];

$empleado = $pdo->query("SELECT * FROM hotel_categoria WHERE codigo_categoria='$codigo'");
$row = $empleado->fetch();

$json = json_encode($row);
echo $json;