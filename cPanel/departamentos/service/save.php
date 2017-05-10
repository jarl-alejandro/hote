<?php
session_start();
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$cliente = $_POST["cliente"];
$fecha = $_POST["fecha"];
$habitaciones = $_POST["habitaciones"];
$total = $_POST["total"];

$empleado = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];
$desc = "Hospedaje en el hotel madison";

$fecha_actual = date("Y/m/d");
$codigo = setCode('RE-', 8, 'hotel_producto', 'cont_reservaciones');
$code = setCode('FT-', 8, 'hotel_facturam', 'cont_facturam');

$row = $pdo->query("SELECT * FROM hotel_reservaciones 
    WHERE codigo_reservacion='$codigo'");

$row_code = $pdo->query("SELECT * FROM hotel_facturam 
    WHERE codigo_facturam='$code'");

$habitacion_ocupadas = array();

if($row->rowCount() > 0){
  $res = array('status'=>1);
  $reservacione_respnse[] = array('response'=>$res);
  $json = json_encode($reservacione_respnse);
  echo $json;
  return false;
}

if($row_code->rowCount() > 0){
  $res = array('status'=>1);
  $reservacione_respnse[] = array('response'=>$res);
  $json = json_encode($reservacione_respnse);
  echo $json;
  return false;
}


$new = $pdo->query("INSERT INTO hotel_reservaciones (codigo_reservacion, cliente_reservacion, fecha_habitacion, estado_habitacion, es_reservacion)
    VALUES ('$codigo', '$cliente', '$fecha', 'ocupado', 'departamento')");

$factura = $pdo->query("INSERT INTO hotel_facturam (codigo_reservacion, codigo_facturam, cliente_facturam, fecha_facturam, detealle_facturam, empleado_facturam, total_facturam, es_facturam)
  VALUES ('$codigo', '$code', '$cliente', '$fecha_actual', '$desc', 
  '$empleado', '$total', 'departamento')");

$pdo->query("UPDATE hotel_cliente SET estado_cliente='2' 
  WHERE cedula_cliente='$cliente'");

/* Itero en un ciclo foreach las habitaciones y valido que en los dias que se opspede no haya otra reservacion
*/


foreach ($habitaciones as $habitacion) {
  $habitacion_reservada = $habitacion["codigo"];
  $adultos = $habitacion["adultos"];
  $children = $habitacion["children"];
  $cant = $habitacion["cant"];
  $valor = $habitacion["valor"];

  $detail = $pdo->query("INSERT INTO detalle_reservaciones (codigo_detalle, codigo_habitacion, adultos_detalle, children_detalle, cant_detalle)
    VALUES ('$codigo', '$habitacion_reservada', '$adultos', '$children', '$cant')");

  $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='10',
    desde_fecha='$fecha' WHERE codigo_habitacion='$habitacion_reservada'");

  $pdo->query("INSERT INTO detalle_facturam (codigo_facturam, cant_facturad, codigo_habitacion, unit_facturad, total_facturad)
    VALUES ('$code', '1', '$habitacion_reservada', '$valor', '$valor')");

}

// Fin de la iterecion

if($new) {
  actualizar_parametro('cont_reservaciones');
  actualizar_parametro('cont_facturam');
  $res = array('status'=>201);

  $reservacione_respnse[] = array('ocupadas' => $habitacion_ocupadas, 'response'=>$res);
  $json = json_encode($reservacione_respnse);
  echo $json;
}
