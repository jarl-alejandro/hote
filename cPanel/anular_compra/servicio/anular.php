<?php
include '../../../bd/db.php';
$codigo = $_POST["codigo"];

$prodQry = $pdo->query("SELECT * FROM detalle_pedidos WHERE codigo_pedido='$codigo'");

foreach ($prodQry as $producto) {
  $codigo_prod = $producto["codigo_producto"];
  $pdo->query("UPDATE hotel_producto SET estado_pendiente='0' WHERE codigo_producto='$codigo_prod'");
}



$row = $pdo->query("DELETE FROM hotel_pedidos WHERE codigo_pedido='$codigo'");
$pdo->query("DELETE FROM detalle_pedidos WHERE codigo_pedido='$codigo'");

if ($row) {
  $response[] = array('status'=>200);
  $json = json_encode($response);
  echo $json;
}
else {
  print_r($pdo->errorInfo());
}
