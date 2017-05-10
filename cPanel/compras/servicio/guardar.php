<?php
include '../../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$factura = $_POST["factura"];
$productos = $_POST["producto"];
$pedidos = $_POST["pedidos"];
$fecha = date("Y/m/d");

$pdo->query("INSERT INTO tmp_compra (comp_cod, comp_factura, comp_fecha) VALUES ('$pedidos', '$factura', '$fecha')");

foreach ($productos as $producto) {
  $id = $producto["producto"];
  $cant = $producto["cant"];
  $valor = $producto["valor"];

  $pdo->query("INSERT INTO dtmp_compra (cdtmp_prod, cdtmp_cant, cdtmp_valor, cdtmp_cod) VALUES ('$id', '$cant', '$valor', '$pedidos')");

  $query = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$id'");
  $producto = $query->fetch();
  $count = $producto["cantidad_producto"];

  $suma = $cant + $count;
  $update = $pdo->query("UPDATE hotel_producto SET cantidad_producto='$suma', valor_producto='$valor', estado_producto='0', estado_pendiente='0' WHERE codigo_producto='$id'");

  // Kardex

  $kardex_query = $pdo->query("SELECT * FROM hotel_kardex WHERE codigo_producto='$id'");
  $kardex = $kardex_query->fetch();
  $code_kardex = $kardex["codigo_kardex"];

  $detail_kardex = $pdo->query("SELECT * FROM detalle_kardex WHERE codigo_kardex='$code_kardex' 
    ORDER BY id_detalle DESC LIMIT 1");

  $detail = $detail_kardex->fetch();

  $exist_cant = $detail["exist_cant"];
  $exist_val = $detail["exist_val"];
  $exist_sub = $detail["exist_sub"];

  $subt = $valor * $cant;

  $total_cant = $valor * $exist_sub;

  $cantExist = $exist_cant + $cant;
  $valExist = ($exist_val + $valor) / 2;
  $subExist = $cantExist * $valExist;

  $detalle = "Por compra segun factura #" . $factura;

  $pdo->query("INSERT INTO detalle_kardex (codigo_kardex, desc_kardex, ent_cant, ent_val, ent_sub, sal_cant, sal_val, sal_sub, exist_cant, exist_val, exist_sub)
    VALUES ('$code_kardex', '$detalle', '$cant', '$valor', '$subt', '0', '0', '0', '$cantExist', '$valExist', '$subExist')");

  // Fin Kardex
}

$row = $pdo->query("DELETE FROM hotel_pedidos WHERE codigo_pedido='$pedidos'");
$pdo->query("DELETE FROM detalle_pedidos WHERE codigo_pedido='$pedidos'");

if ($row) {
 echo 2;
}
else {
  print_r($pdo->errorInfo());
}
