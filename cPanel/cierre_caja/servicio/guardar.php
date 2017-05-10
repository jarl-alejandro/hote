<?php session_start();
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$codigo = setCode('MC-', 8, 'cierrec_moneda', 'cont_ccmoneda');
$monedas = $_POST["monedas"];
$empleado = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];
$fecha_actual = date("Y/m/d");

foreach ($monedas as $moneda) {
  $money = $moneda["codigo"];
  $cant = $moneda["cant"];
  $total = $moneda["total"];

  $pdo->query("INSERT INTO cierrec_moneda (codigo_ccmoneda, rel_ccmoneda, 
    cant_ccmoneda, total_ccmoneda)
    VALUES ('$codigo', '$money', '$cant', '$total')");

}

$update = $pdo->query("UPDATE hotel_empleado SET estado_empleado='bloqueado', 
  fecha_bloqueado='$fecha_actual' WHERE cedula_empleado='$empleado'");

if($update){
  actualizar_parametro('cont_ccmoneda');

  $response = array('status'=>2, "codigo"=>$codigo);
  $json = json_encode($response);
  echo $json;
  
}


