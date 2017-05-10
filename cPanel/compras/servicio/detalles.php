<?php

include '../../../bd/db.php';

$codigo = $_GET["codigo"];
$pedidos = array();

$query = $pdo->query("SELECT * FROM vista_pedidos_detalle WHERE codigo_pedido='$codigo'");

foreach ($query as $row) {
  $pedidos[] = array("producto"=>$row["codigo_producto"], "cant"=>$row["cant_pedido"],
    "precio"=>$row["precio_pedido"], "id"=>$row["id_pedido"], "nombre"=>$row["nombre_producto"], "valor"=>$row["valor_producto"]);
}

$json = json_encode($pedidos);
echo $json;

