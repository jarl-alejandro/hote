<?php
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$habitacion_codigo = $_POST["habitacion_codigo"];
$detalle = $_POST["detalle"];
$productos = $_POST["productos"];
$total = $_POST["total"];
$fecha_actual = date("Y/m/d");

$codigo = setCode('VT-', 8, 'hotel_ventas', 'cont_ventas');

$row = $pdo->query("SELECT * FROM hotel_ventas WHERE codigo_venta='$codigo'");

if($row->rowCount() > 0){
  $json = array("status"=>1, "codigo"=>$codigo);
  print json_encode($json);
  return false;
}

$queryf = $pdo->query("SELECT * FROM detalle_facturam WHERE codigo_habitacion='$habitacion_codigo'");
$row_fact = $queryf->fetch();
$factura = $row_fact["codigo_facturam"];

$new = $pdo->query("INSERT INTO hotel_ventas (codigo_venta, habitacion_venta, fecha_venta, detalle_venta, total_venta, codigo_facturam)
  VALUES ('$codigo', '$habitacion_codigo', '$fecha_actual', '$detalle', '$total', '$factura')");

$fact_que = $pdo->query("SELECT * FROM hotel_facturam WHERE codigo_facturam='$factura'");
$fact_row = $fact_que->fetch();
$tot_fact = $total + $fact_row["total_facturam"];
$pdo->query("UPDATE hotel_facturam SET total_facturam='$tot_fact' WHERE codigo_facturam='$factura'");

foreach ($productos as $producto) {
  $cant = $producto["cant"];
  $prod = $producto["codigo"];
  $valor = $producto["valor"];
  $total = $producto["total"];

  $pdo->query("INSERT INTO detalle_ventas (codigo_ventad, cant_ventad, detalle_ventad, unit_vantad, total_ventad) 
   VALUES ('$codigo', '$cant', '$prod', '$valor', '$total')");

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

  $detalle = "Por Venta a la habitacion $habitacion_codigo segun factura nro $codigo";

  $pdo->query("INSERT INTO detalle_kardex (codigo_kardex, desc_kardex, ent_cant, ent_val, ent_sub, sal_cant, sal_val, sal_sub, exist_cant, exist_val, exist_sub)
    VALUES ('$code_kardex', '$detalle', '0', '0', '0', '$cant', '$valor', '$subt', '$cantExist', '$valExist', '$subExist')");

  // Fin Kardex

}

if($new){
  actualizar_parametro('cont_ventas');
  $json = array("status"=>2, "codigo"=>$codigo);
  print json_encode($json);
}