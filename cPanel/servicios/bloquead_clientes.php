<?php
include '../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$fecha = date("Y/m/d");
$hora = "12:00";
$hora_actual = date("G:i");

$clientes = $pdo->query("SELECT * FROM vista_reservacion WHERE fecha_habitacion='$fecha'");

foreach ($clientes as $cliente) {

  if($hora_actual == $hora) {
    $cedula = $cliente["cedula_cliente"];

    $pdo->query("UPDATE hotel_cliente SET estado_cliente='2' WHERE cedula_cliente='$cedula'");
  }

}
