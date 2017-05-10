<?php 
include '../../../bd/db.php';

$codigo = $_POST["codigo"];
$detalle = $_POST["det"];
$descuento = $_POST["desc"];
$valor = $_POST["valor"];

// $desc_val = ($descuento / 100) * $valor;

$desc_val = ($descuento * $valor) / 100;
$promo = $valor - $desc_val;

$update = $pdo->query("UPDATE hotel_habitacion SET detalle_promocion='$detalle', 
  desc_promocion='$descuento', valor_promocion='$valor', valor_habitacion='$promo', 
  estado_promocion='promocion' WHERE codigo_habitacion='$codigo'");

if ($update) {
  $pdo->query("UPDATE hotel_parametro SET promocion='1' WHERE id_parametro=1 LIMIT 1");
  echo 2;
}