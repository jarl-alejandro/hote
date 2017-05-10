<?php

include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$detalle = $_POST["detalle"];
$productos = $_POST["productos"];
$fecha_actual = date("Y/m/d");

$codigo = setCode('PE-', 8, 'hotel_pedidos', 'cont_pedido');
$productos_pendientes = array();

foreach ($productos as $producto) {
  $codigo_prod = $producto["codigo"];
  $cant = $producto["cant"];
  $precio = $producto["precio"];
  $nombre = $producto["nombre"];

  $pendind = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$codigo_prod' AND estado_pendiente='1'");

  if($pendind->rowCount() > 0){
    $arrayPendient = array( 'codigo'=>$codigo_prod, 'nombre'=>$nombre, 'status'=>'pendiente' );
    $productos_pendientes[] = $arrayPendient;
    $res = array('status'=>203, "productos_pendientes"=>$productos_pendientes);
    $json = json_encode($res);
    echo $json;
    return false;
  }
  else {
    $pdo->query("UPDATE hotel_producto SET estado_pendiente='1' WHERE codigo_producto='$codigo_prod'");

    $pdo->query("INSERT INTO detalle_pedidos (codigo_pedido, codigo_producto, cant_pedido, precio_pedido) 
      VALUES ('$codigo', '$codigo_prod', '$cant', '$precio')");    
  }

}

$new = $pdo->query("INSERT INTO hotel_pedidos (codigo_pedido, detalle_pedido, fecha_pedido) 
  VALUES ('$codigo', '$detalle', '$fecha_actual')");

if($new) {
  $res = array('status'=>2, "codigo"=>$codigo);
  $json = json_encode($res);
  echo $json;
  actualizar_parametro('cont_pedido');
}
