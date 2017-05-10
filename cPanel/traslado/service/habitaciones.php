<?php
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$fecha_actual = date("Y/m/d");
$codigo = $_GET["codigo"];

$query = $pdo->query("SELECT * FROM vista_reservacion_habitacion WHERE
  nombre_habitacion='$codigo'");

$reservacion = $query->fetch();
$code_reservacion = $reservacion["codigo_detalle"];

$maester = $pdo->query("SELECT * FROM vista_reservacion WHERE
  codigo_reservacion='$code_reservacion'");

$row = $maester->fetch();

$habitacion = array('cedula'=>$row["cedula_cliente"],
  'cliente'=>$row["nombre_cliente"]." ".$row["apellido_cliente"], 'valor'=>$reservacion["valor_habitacion"]);

$json = json_encode($habitacion);
echo $json;
