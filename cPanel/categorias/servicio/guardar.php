<?php

include '../../../bd/db.php';
require('../../servicios/codigo.php');

$id = $_POST["id"];
$categoria = $_POST["categoria"];
$descripcion = $_POST["descripcion"];
$cant = $_POST["cant"];

$codigo = setCode('CT-', 8, 'hotel_categoria', 'cont_categoria');

if($id != "") {
  $update = $pdo->query("UPDATE hotel_categoria SET nombre_categoria='$categoria', descripcion_categoria='$descripcion', cant_categoria='$cant' WHERE codigo_categoria='$id'");

  if($update) {
    echo 20;
  }

} else {

  $row = $pdo->query("SELECT * FROM hotel_categoria WHERE codigo_categoria='$codigo'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new = $pdo->query("INSERT INTO hotel_categoria (codigo_categoria, nombre_categoria, descripcion_categoria, cant_categoria)
    VALUES ('$codigo', '$categoria', '$descripcion', '$cant')");

  if($new) {
    actualizar_parametro('cont_categoria');
    echo 2;
  }

}
