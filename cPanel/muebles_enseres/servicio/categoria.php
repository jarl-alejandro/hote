<?php
include '../../../bd/db.php';

$codigo = $_GET["codigo"];

$empleado = $pdo->query("SELECT * FROM hotel_muebles WHERE codigo_mueble='$codigo'");
$row = $empleado->fetch();

$json = json_encode($row);
echo $json;
