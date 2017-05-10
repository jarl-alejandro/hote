<?php

include '../../../bd/db.php';
require('../../servicios/codigo.php');

$id = $_POST["id"];
$desc = $_POST["desc"];
$precio = $_POST["precio"];
$vida = $_POST["vida"];

$codigo = setCode('ME-', 8, 'hotel_muebles', 'cont_muebles');

if($id != "") {
  $update = $pdo->query("UPDATE hotel_muebles SET desc_mueble='$desc', vida_mueble='$vida', precio_mueble='$precio' WHERE codigo_mueble='$id'");

  if($update) {
    echo 20;
  }
} else {

  $row = $pdo->query("SELECT * FROM hotel_muebles WHERE codigo_mueble='$codigo'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new = $pdo->query("INSERT INTO hotel_muebles (codigo_mueble, precio_mueble, desc_mueble, vida_mueble)
    VALUES ('$codigo', '$precio', '$desc', '$vida')");

  if($new) {
    actualizar_parametro('cont_muebles');
    echo 2;
  }

}
