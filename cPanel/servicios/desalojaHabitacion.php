<?php
include '../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$fecha_actual = date("Y/m/d");
$desalojos = $pdo->query("SELECT * FROM v_desalojo WHERE des_fet='$fecha_actual'");

while($row = $desalojos->fetch()) {
  $cedula = $row["cedula_cliente"];
  $codigo = $row["codigo_facturam"];
  $reservacion = $row["codigo_reservacion"];

  $id = $row["des_id"];

  $desalojo = $pdo->query("DELETE FROM hotel_desalojo WHERE des_alqui='$id'");
  $pdo->query("UPDATE hotel_reservaciones SET aviso_estado='' WHERE codigo_reservacion='$id'");

  $update = $pdo->query("UPDATE hotel_cliente SET estado_cliente='0' WHERE cedula_cliente='$cedula'");
  $pdo->query("UPDATE hotel_reservaciones SET estado_habitacion='pagado' WHERE codigo_reservacion='$reservacion'");
  $pdo->query("UPDATE hotel_facturam SET factura_estado='pagado', fecha_facturam='$fecha_actual' 
                WHERE codigo_facturam='$codigo'");

  $detalle = $pdo->query("SELECT * FROM detalle_facturam WHERE codigo_facturam='$codigo'");
  foreach ($detalle as $row) {
    $habitacion = $row["codigo_habitacion"];

    $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='0' WHERE codigo_habitacion='$habitacion'");
    $pdo->query("DELETE FROM tmp_reservacion_h WHERE cod_habit ='$habitacion'");

    $pdo->query("UPDATE detalle_reservaciones SET estado_reservacion='0' WHERE codigo_habitacion='$habitacion'");
  }

}