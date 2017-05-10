<?php 
include '../../../bd/db.php';

$cedula = $_POST["cedula"];

$ingresar = $pdo->query("UPDATE hotel_cliente SET estado_cliente='1' WHERE cedula_cliente='$cedula'");
$reser_row = $pdo->query("SELECT * FROM hotel_reservaciones WHERE cliente_reservacion='$cedula'");
$reservaciones = $reser_row->fetch();
$codigo = $reservaciones["codigo_reservacion"];

$pdo->query("UPDATE detalle_reservaciones SET estado_reservacion='1' WHERE codigo_detalle='$codigo'");

if($ingresar) {
  echo 2;
} else {
  echo 1;
}