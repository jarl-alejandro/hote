<?php

include '../../../bd/db.php';

$id_code = $_POST["ventas"];
$productos = $_POST["productos"];

foreach ($productos as $producto) {
  $id = $producto["producto"];
  $cant = $producto["cant"];
  $valor = $producto["precio"];


  $detalle = "Devolucion de venta del producto $id";

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

  $cantExist = $cant + $exist_cant;
  $valExist = ($exist_val + $valor) / 2;
  $subExist = $cantExist * $valExist;

  $pdo->query("INSERT INTO detalle_kardex (codigo_kardex, desc_kardex, ent_cant, ent_val, ent_sub, sal_cant, sal_val, sal_sub, exist_cant, exist_val, exist_sub)
    VALUES ('$code_kardex', '$detalle', '$cant', '$valor', '$subt', '0', '0', '0', '$cantExist', '$valExist', '$subExist')");

  // Fin Kardex
  $update = $pdo->query("UPDATE hotel_producto SET cantidad_producto='$cantExist' WHERE codigo_producto='$id'");

  $pdo->query("DELETE FROM hotel_ventas WHERE codigo_venta='$id_code'");
  $pdo->query("DELETE FROM detalle_ventas WHERE codigo_ventad='$id_code'");

}

echo 2;