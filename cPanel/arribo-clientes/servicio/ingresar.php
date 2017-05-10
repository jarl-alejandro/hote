<?php
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$reserQuery = $pdo->query("SELECT * FROM vista_huespedes WHERE
                  codigo_reservacion='$codigo'");
$reserFetch = $reserQuery->fetch();
$cedula = $reserFetch["cedula_cliente"];

$ingresar = $pdo->query("UPDATE hotel_cliente SET estado_cliente='2' WHERE cedula_cliente='$cedula'");


$pdo->query("UPDATE detalle_reservaciones SET estado_reservacion='1' WHERE codigo_detalle='$codigo'");

$pdo->query("UPDATE hotel_reservaciones SET estado_habitacion='ocupado' WHERE codigo_reservacion='$codigo'");

$row = $pdo->query("SELECT * FROM detalle_reservaciones WHERE codigo_detalle='$codigo'");

foreach ($row as $key) {
  $habitacion_reservada = $key["codigo_habitacion"];

  $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='10' WHERE
                        codigo_habitacion='$habitacion_reservada'");
}
// print_r($pdo->errorInfo());

if($ingresar) {
  echo 2;
} else {
  echo 1;
}
