<?php

include '../../../bd/db.php';

$codigo = $_GET["codigo"];
$pedidos = array();

$query = $pdo->query("SELECT * FROM vista_ventas WHERE codigo_ventad='$codigo'");

foreach ($query as $row) {
  $pedidos[] = array("producto"=>$row["detalle_ventad"], "cant"=>$row["cant_ventad"],
    "precio"=>$row["unit_vantad"], "id"=>$row["id_ventad"], "nombre"=>$row["nombre_producto"], "valor"=>$row["total_ventad"]);
}

$json = json_encode($pedidos);
echo $json;

