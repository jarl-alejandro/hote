<?php
session_start();
include '../../../bd/db.php';

date_default_timezone_set('America/Guayaquil');

$cliente = $_GET["cliente"];
$codigo = $_GET["codigo"];

$query = $pdo->query("SELECT * FROM hotel_reservaciones WHERE codigo_reservacion='$codigo'");
$reservacion = $query->fetch();

$details = $pdo->query("SELECT * FROM vista_reservacion_habitacion WHERE codigo_detalle='$codigo'");
$habitaciones = array();

foreach($details as $detail) {
    $habitaciones[] = $detail;
}

$editar[] = array('reservacion'=>$reservacion, 'habitaciones'=> $habitaciones);

$json = json_encode($editar);
echo $json;
