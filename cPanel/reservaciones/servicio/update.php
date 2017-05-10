<?php
session_start();
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$codigo = $_POST["codigo"];
$habitaciones = $_POST["habitaciones"];
$total = $_POST["total"];
$fecha = $_POST["desde"];
$hasta = $_POST["hasta"];

$pdo->query("UPDATE hotel_reservaciones SET hasta_habitacion='$hasta'
      WHERE codigo_reservacion='$codigo'");

$pdo->query("DELETE FROM detalle_reservaciones WHERE codigo_detalle='$codigo'");
$pdo->query("UPDATE hotel_facturam SET total_facturam='$total' WHERE codigo_reservacion='$codigo'");

$query = $pdo->query("SELECT * FROM hotel_facturam WHERE codigo_reservacion='$codigo'");
$factura = $query->fetch();
$code = $factura["codigo_facturam"];

$pdo->query("DELETE FROM detalle_facturam WHERE codigo_facturam='$code'");

foreach ($habitaciones as $habitacion) {
  $habitacion_reservada = $habitacion["codigo"];
  $adultos = $habitacion["adultos"];
  $children = $habitacion["children"];
  $cant = $habitacion["cant"];
  $valor = $habitacion["valor"];

  $pdo->query("DELETE FROM tmp_reservacion_h WHERE cod_habit='$habitacion_reservada'");

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
    $pdo->query("INSERT INTO tmp_reservacion_h (fecha_init, fecha_fin, cod_habit)
        VALUES ('$fecha', '$hasta', '$habitacion_reservada')");

    $detail = $pdo->query("INSERT INTO detalle_reservaciones (codigo_detalle, codigo_habitacion, adultos_detalle, children_detalle, cant_detalle)
      VALUES ('$codigo', '$habitacion_reservada', '$adultos', '$children', '$cant')");

    $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='1', hasta_fecha='$hasta' WHERE codigo_habitacion='$habitacion_reservada'");

    $pdo->query("INSERT INTO detalle_facturam (codigo_facturam, cant_facturad, codigo_habitacion, unit_facturad, total_facturad)
      VALUES ('$code', '1', '$habitacion_reservada', '$valor', '$valor')");

  }

}