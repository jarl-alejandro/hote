<?php
include '../../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$fecha_actual = date("Y/m/d");
$cedula = $_POST["cedula"];
$codigo = $_POST["codigo"];
$reservacion = $_POST["reservacion"];
$deposito = $_POST["deposito"];

$update = $pdo->query("UPDATE hotel_cliente SET estado_cliente='0' WHERE cedula_cliente='$cedula'");

$pdo->query("UPDATE hotel_facturam SET factura_estado='pagado', factura_deposito='$deposito',
  fecha_facturam='$fecha_actual' WHERE codigo_facturam='$codigo'");

$pdo->query("UPDATE hotel_ventas SET venta_estado='pagado' WHERE codigo_facturam='$codigo'");

$pdo->query("UPDATE hotel_reservaciones SET estado_habitacion='pagado' WHERE codigo_reservacion='$reservacion'");

$detalle = $pdo->query("SELECT * FROM detalle_facturam WHERE codigo_facturam='$codigo'");
$detalle_ventas = $pdo->query("SELECT * FROM hotel_ventas WHERE codigo_facturam='$codigo'");

foreach ($detalle_ventas as $venta) {
  $codigo_venta = $venta["codigo_venta"];
  $det_venta = $pdo->query("SELECT * FROM vista_ventas WHERE codigo_ventad='$codigo_venta'");

  foreach ($det_venta as $key) {
    $tipo_prod = $key["tipo_producto"];

    if($tipo_prod == "servicios") {
      $cant = $key["cant_ventad"];
      $service = $key["detalle_ventad"];

      $row_prdo = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$service'");
      $prod_fetch = $row_prdo->fetch();
      $cant_prod = $prod_fetch["cantidad_producto"];
      $total_cant = $cant_prod + $cant;
      
      $pdo->query("UPDATE hotel_producto SET cantidad_producto='$total_cant'
          WHERE codigo_producto='$service'");

    }

  }

}

foreach ($detalle as $row) {
  $habitacion = $row["codigo_habitacion"];

  $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='0' WHERE codigo_habitacion='$habitacion'");
  $pdo->query("DELETE FROM tmp_reservacion_h WHERE cod_habit ='$habitacion'");

  $pdo->query("UPDATE detalle_reservaciones SET estado_reservacion='0' WHERE codigo_habitacion='$habitacion'");
}

if($update) {
  echo 2;
} else {
  echo 1;
}
