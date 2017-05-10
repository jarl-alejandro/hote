<?php 
include '../../../bd/db.php';

$codigo = $_POST["id"];
$valor = $_POST["valor"];

$update = $pdo->query("UPDATE hotel_habitacion SET detalle_promocion='', 
  desc_promocion='0', valor_promocion='0', valor_habitacion='$valor', 
  estado_promocion='' WHERE codigo_habitacion='$codigo'");

$count = $pdo->query("SELECT * FROM hotel_habitacion WHERE estado_promocion='promocion'");

if($count->rowCount() == 0){
  $pdo->query("UPDATE hotel_parametro SET promocion='0' WHERE id_parametro=1 LIMIT 1");
}

if ($update) {
  echo 2;
}
