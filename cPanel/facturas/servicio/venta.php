<?php
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$row = $pdo->query("SELECT * FROM vista_ventaf WHERE codigo_venta='$codigo'");
$v = $row->fetch();

$venta = array("detalle"=>$v["detalle_venta"], "fecha"=>$v["fecha_venta"],
 "total"=>$v["total_venta"], "habitacion"=>$v["nombre_habitacion"],
 "cliente"=>$v["cliente"]);

$detalle = array();

$r_detail = $pdo->query("SELECT * FROM vista_ventas WHERE codigo_ventad='$codigo'");

foreach ($r_detail as $detail) {
  $cant = $detail["cant_ventad"];
  $producto = $detail["nombre_producto"];
  $unit = $detail["unit_vantad"];
  $total = $detail["total_ventad"];

  $detalle[] = array('cant'=>$cant, 'producto'=>$producto, 'unit'=>$unit, 'total'=>$total);
}

$factura[] = array('venta'=>$venta, 'detalle'=> $detalle);

$json = json_encode($factura);
echo $json;
