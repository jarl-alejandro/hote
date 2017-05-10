<?php
session_start();
include '../bd/db.php';

date_default_timezone_set('America/Guayaquil');

if(isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){
  $cliente = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];
  $habitaciones = array();

  $compras = $pdo->query("SELECT * FROM tmp_carrito WHERE user_id='$cliente'");

  if($compras->rowCount() == 0){
    $res = array('status'=>404);
    $json = json_encode($res);
    echo $json;
    return false;
  }

  foreach ($compras as $compra) {
    $codigo = $compra["habitacion_id"];
    $valor = $compra["valor"];
    $categoria = $compra["categoria"];
    $habitacion = $compra["habitacion"];
    $adultos = $compra["adultos"];
    $children = $compra["children"];
    $cant = $compra["cant"];
    $ocupado = $compra["ocupado"];

    $habitaciones[] = array('codigo'=>$codigo, 'valor'=>$valor, 'categoria'=>$categoria,
      'habitacion'=>$habitacion, 'adultos'=>$adultos, 'children'=>$children, 
      'cant'=>$cant, 'ocupado'=>$ocupado );

  }

  $status = array('status'=>200);
  $response = array('status'=>$status, 'habitaciones'=>$habitaciones);
  $json = json_encode($response);
  echo $json;
}
else {
  $res = array('status'=>403);

  $json = json_encode($res);
  echo $json;
}
