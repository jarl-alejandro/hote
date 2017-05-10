<?php
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$fecha_actual = date("Y/m/d");

$habitacion = $_POST["habitacion"];
$nuevaHabitacion = $_POST["nuevaHabitacion"];
$valor = $_POST["valor"];
$boolean = $valor == 'true' ? true : false;

$pdo->query("INSERT INTO tmp_traslado (tras_hnue, tras_hvie, tras_fecha) 
      VALUES ('$nuevaHabitacion', '$habitacion', '$fecha_actual')");

$query = $pdo->query("SELECT * FROM vista_reservacion_habitacion WHERE
  nombre_habitacion='$habitacion'");

$reservacion = $query->fetch();
$code_habitacion = $reservacion["codigo_habitacion"];

$pdo->query("UPDATE detalle_reservaciones SET
  codigo_habitacion='$nuevaHabitacion' WHERE
  codigo_habitacion='$code_habitacion'");

$pdo->query("UPDATE hotel_habitacion SET estado_habitacion='10' WHERE
  codigo_habitacion='$nuevaHabitacion'");

$edit = $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='0' WHERE
  codigo_habitacion='$code_habitacion'");

$tmp_query = $pdo->query("SELECT * FROM  tmp_reservacion_h WHERE cod_habit='$code_habitacion'");
$temp_fetch = $tmp_query->fetch();

$fecha_new = $temp_fetch["fecha_init"];
$fecha_fin_new = $temp_fetch["fecha_fin"];

$pdo->query("INSERT INTO tmp_reservacion_h (fecha_init, fecha_fin, cod_habit)
        VALUES ('$fecha_new', '$fecha_fin_new', '$nuevaHabitacion')");

$pdo->query("DELETE FROM  tmp_reservacion_h WHERE cod_habit='$code_habitacion'");

if(!$boolean) {
  $newH = $pdo->query("SELECT * FROM hotel_habitacion WHERE
    codigo_habitacion='$nuevaHabitacion'");
  $habitacionNew = $newH->fetch();

  $valorNew = $habitacionNew["valor_habitacion"];

  $pdo->query("UPDATE detalle_reservaciones SET valor_detalle='$valorNew' WHERE
    codigo_habitacion='$nuevaHabitacion'");
}

if($edit) {
  echo 2;
}
