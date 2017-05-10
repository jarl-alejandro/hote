<?php 
include '../../../bd/db.php';

$codigo = $_GET["codigo"];

$egreso = $pdo->query("SELECT * FROM hotel_egreso WHERE codigo_egreso='$codigo'");
$row = $egreso->fetch();

$json = json_encode($row);
echo $json;