<?php 
include '../../../bd/db.php';

$codigo = $_GET["codigo"];

$empleado = $pdo->query("SELECT * FROM hotel_moneda WHERE codigo_moneda='$codigo'");
$row = $empleado->fetch();

$json = json_encode($row);
echo $json;