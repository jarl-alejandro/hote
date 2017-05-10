<?php
include '../../../bd/db.php';

$id = $_POST["id"];
$details = array();

$detailQuery = $pdo->query("SELECT * FROM view_detalle_enseres
              WHERE codigo_habitacion='$id'");

foreach ($detailQuery as $row) {
  $id = $row["codigo_mueble"];
  $desc = $row["desc_mueble"];
  $cant = $row["detalle_cant"];
  $price = $row["precio_mueble"];
  $total = $row["detalle_total"];

  $details[] = array('id'=>$id, 'desc'=>$desc, 'cant'=>$cant, 'total'=>$total,
                      'price'=>$price);
}

$hab[] = array('detalle'=> $details);

$json = json_encode($hab);
echo $json;
