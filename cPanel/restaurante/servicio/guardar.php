<?php
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');


$cliente = $_POST["cliente"];
$productos = $_POST["productos"];
$subtotal = $_POST["subtotal"];
$iva = $_POST["iva"];
$desc = $_POST["desc"];
$porcent = $_POST["porcent"];
$total = $_POST["total"];
$deposito = $_POST["deposito"];
$fecha_actual = date("Y/m/d");

$codigo = setCode('VT-', 8, 'hotel_restaurante', 'cont_restaurante');

$row = $pdo->query("SELECT * FROM hotel_restaurante WHERE codigo_restaurante='$codigo'");

if($row->rowCount() > 0){
  $json = array("status"=>1, "codigo"=>$codigo);
  print json_encode($json);
  return false;
}


$new = $pdo->query("INSERT INTO hotel_restaurante (codigo_restaurante, cliente_restaurante, fecha_restaurante, total_restaurante, deposito_restaurante, subtotal, iva, descu, porcen)
  VALUES ('$codigo', '$cliente', '$fecha_actual', '$total' , '$deposito', '$subtotal', '$iva', '$desc', '$porcent')");

foreach ($productos as $producto) {
  $cant = $producto["cant"];
  $prod = $producto["codigo"];
  $valor = $producto["valor"];
  $totalProd = $producto["total"];

  $pdo->query("INSERT INTO detalle_restaurante (codigo_restaurante, cant_restaurante, desc_restaurante, unit_restaurante, total_restaurante) 
   VALUES ('$codigo', '$cant', '$prod', '$valor', '$totalProd')");

  $row_prdo = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$prod'");
  $prod_fetch = $row_prdo->fetch();
  $tipo_prod = $prod_fetch["tipo_producto"];
  $cant_prod = $prod_fetch["cantidad_producto"];
  $minimo_prod = $prod_fetch["minimo_producto"];

  $total_cant = $cant_prod - $cant;

  $pdo->query("UPDATE hotel_producto SET cantidad_producto='$total_cant' WHERE codigo_producto='$prod'");

  if($minimo_prod >= $total_cant) {
    $pdo->query("UPDATE hotel_producto SET estado_producto='1' WHERE codigo_producto='$prod'");
  }

  // Kardex

  $kardex_query = $pdo->query("SELECT * FROM hotel_kardex WHERE codigo_producto='$prod'");
  $kardex = $kardex_query->fetch();
  $code_kardex = $kardex["codigo_kardex"];

  $detail_kardex = $pdo->query("SELECT * FROM detalle_kardex WHERE codigo_kardex='$code_kardex' 
    ORDER BY id_detalle DESC LIMIT 1");

  $detail = $detail_kardex->fetch();

  $exist_cant = $detail["exist_cant"];
  $exist_val = $detail["exist_val"];
  $exist_sub = $detail["exist_sub"];

  $subt = $valor * $cant;
  $total_cant = $cant * $exist_val;

  $cantExist = ($cant - $exist_cant) * -1;
  $valExist = ($exist_sub - $total_cant) / $cantExist;
  $subExist = $cantExist * $valExist;

  $detalle = "Por Venta al $cliente segun factura nro $codigo";

  $pdo->query("INSERT INTO detalle_kardex (codigo_kardex, desc_kardex, ent_cant, ent_val, ent_sub, sal_cant, sal_val, sal_sub, exist_cant, exist_val, exist_sub)
    VALUES ('$code_kardex', '$detalle', '0', '0', '0', '$cant', '$valor', '$subt', '$cantExist', '$valExist', '$subExist')");

  // Fin Kardex
}

if($new){
  actualizar_parametro('cont_restaurante');
  $json = array("status"=>2, "codigo"=>$codigo);
  print json_encode($json);
}