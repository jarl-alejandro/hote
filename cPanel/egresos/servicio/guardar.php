<?php

include '../../../bd/db.php';
require('../../servicios/codigo.php');

$id = $_POST["id"];
$referencia = $_POST["referencia"];
$valor = $_POST["valor"];
date_default_timezone_set('America/Guayaquil');
$fecha_actual = date("Y/m/d");

$codigo = setCode('EG-', 8, 'hotel_egreso', 'cont_egreso');

if($id != "") {
  $update = $pdo->query("UPDATE hotel_egreso SET referencia_egreso='$referencia', valor_egreso='$valor' WHERE codigo_egreso='$id'");

  if($update) {
    echo 20;
  }

} else {

  $row = $pdo->query("SELECT * FROM hotel_egreso WHERE codigo_egreso='$codigo'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new = $pdo->query("INSERT INTO hotel_egreso (codigo_egreso, referencia_egreso, valor_egreso, fecha_egreso)
    VALUES ('$codigo', '$referencia', '$valor', '$fecha_actual')");

  if($new) {
    actualizar_parametro('cont_egreso');
    echo 2;
  }

}
