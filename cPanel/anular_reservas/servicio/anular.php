<?php
include '../../../bd/db.php';
$codigo = $_POST["codigo"];

$detalles = $pdo->query("SELECT * FROM detalle_reservaciones WHERE codigo_detalle='$codigo'");
$cl_row = $pdo->query("SELECT * FROM hotel_reservaciones WHERE codigo_reservacion='$codigo'");
$reser = $cl_row->fetch();

$cliente = $reser["cliente_reservacion"];

foreach ($detalles as $detalle) {
  $codigo_hab = $detalle["codigo_habitacion"];
  $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='0' WHERE codigo_habitacion='$codigo_hab'");
  $pdo->query("DELETE FROM tmp_reservacion_h WHERE cod_habit ='$codigo_hab'");
}

$row = $pdo->query("DELETE FROM hotel_reservaciones WHERE codigo_reservacion='$codigo'");
$pdo->query("DELETE FROM hotel_facturam WHERE cliente_facturam='$cliente'");

$pdo->query("DELETE FROM detalle_reservaciones WHERE codigo_detalle='$codigo'");

if ($row) {
  echo 2;
}
else {
  print_r($pdo->errorInfo());
}
