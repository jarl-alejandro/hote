<?php 
include '../../../bd/db.php';

$cedula = $_GET["cedula"];

$empleado = $pdo->query("SELECT * FROM hotel_cliente WHERE cedula_cliente='$cedula'");
$row = $empleado->fetch();

$json = json_encode($row);
echo $json;