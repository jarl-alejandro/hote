<?php
session_start();
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$fecha = $_POST["fecha"];
$hasta = $_POST["hasta"];
$habitaciones = $_POST["habitaciones"];
$habitacion_ocupadas = array();

foreach ($habitaciones as $habitacion) {
  $habitacion_reservada = $habitacion["codigo"];
  
  $valid = "SELECT * FROM tmp_reservacion_h WHERE (
    (fecha_init <='$fecha' AND fecha_fin >= '$hasta')
    OR fecha_init BETWEEN '$fecha' AND '$hasta'
    OR fecha_fin BETWEEN '$fecha' AND '$hasta')
    AND cod_habit='$habitacion_reservada'";

  $valid_habi = $pdo->query($valid);

  if($valid_habi->rowCount() > 0){
    $arrayHabi = array( 'habitacion'=>$habitacion_reservada, 'status'=>'ocupado' );
    $habitacion_ocupadas[] = $arrayHabi;
  }
  else {
    $arrayHabi = array('status'=>200);
    $habitacion_ocupadas[] = $arrayHabi;
  }
}

$reservacione_response[] = array('ocupadas' => $habitacion_ocupadas);
$json = json_encode($reservacione_response);
echo $json;
