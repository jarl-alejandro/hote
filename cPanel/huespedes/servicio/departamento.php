<?php
include '../../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$fecha = date("Y/m/d");
$mes = date("m");
$cedula = $_POST["cedula"];
$codigo = $_POST["codigo"];
$reservacion = $_POST["reservacion"];
$deposito = $_POST["deposito"];
$total = $_POST["total"];

$mensual = $pdo->prepare("INSERT INTO hotel_mensual (mensual_reservacion,
    mensual_cliente, mensual_precio, mensual_fecha, mensual_deposito, mensual_mes)
    VALUES (?, ?, ?, ?, ?, ?)");

$mensual->bindParam(1, $reservacion);
$mensual->bindParam(2, $cedula);
$mensual->bindParam(3, $total);
$mensual->bindParam(4, $fecha);
$mensual->bindParam(5, $deposito);
$mensual->bindParam(6, $mes);

$mensual->execute();

if($mensual){
  echo 2;
} else {
  echo 1;
}
