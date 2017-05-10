<?php 
include '../../../bd/db.php';

$cedula = $_GET["cedula"];

$empleado = $pdo->query("SELECT * FROM hotel_empleado WHERE cedula_empleado='$cedula'");
$row = $empleado->fetch();

$json = json_encode($row);
echo $json;