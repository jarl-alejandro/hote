<?php 
include '../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$cant = $_POST["cant"];
$codigo = $_POST["codigo"];

$row_prdo = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$codigo'");
$prod_fetch = $row_prdo->fetch();
$cant_prod = $prod_fetch["cantidad_producto"];

$total_cant = $cant_prod + $cant;

$update = $pdo->query("UPDATE hotel_producto SET cantidad_producto='$total_cant', estado_producto='0' 
  WHERE codigo_producto='$codigo'");

if ($update) {
  echo 2;
}