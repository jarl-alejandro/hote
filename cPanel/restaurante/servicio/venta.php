<?php
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$row = $pdo->query("SELECT * FROM vh_restaurante WHERE codigo_restaurante='$codigo'");
$v = $row->fetch();

$venta = array("detalle"=>$v["detalle_restaurante"], "fecha"=>$v["fecha_restaurante"], 
  "cedula"=>$v["cliente_restaurante"], "cliente"=>$v["cliente"], "direccion"=>$v["direccion_cliente"],
  "subtotal"=>$v["subtotal"], "iva"=>$v["iva"], "desc"=>$v["descu"], "porcent"=>$v["porcen"],
  "total"=>$v["total_restaurante"]);

$detalle = array();

$r_detail = $pdo->query("SELECT * FROM vista_detalle_restaurante WHERE codigo_restaurante='$codigo'");

foreach ($r_detail as $detail) {
  $cant = $detail["cant_restaurante"];
  $producto = $detail["nombre_producto"];
  $unit = $detail["unit_restaurante"];
  $total = $detail["total_restaurante"];

  $detalle[] = array('cant'=>$cant, 'producto'=>$producto, 'unit'=>$unit, 'total'=>$total);
}

$factura[] = array('venta'=>$venta, 'detalle'=> $detalle);

$json = json_encode($factura);
echo $json;
