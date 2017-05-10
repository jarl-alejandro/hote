<?php

include '../../../bd/db.php';
require('../../servicios/codigo.php');

$id = $_POST["id"];
$moneda = $_POST["moneda"];
$categoria = $_POST["categoria"];

$codigo = setCode('MD-', 8, 'hotel_moneda', 'cont_moneda');

if($id != "") {
  $update = $pdo->query("UPDATE hotel_moneda SET desc_moneda='$moneda',
    categoria_moneda='$categoria' WHERE codigo_moneda='$id'");

  if($update) {
    echo 20;
  }

} else {

  $row = $pdo->query("SELECT * FROM hotel_moneda WHERE codigo_moneda='$codigo'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new = $pdo->query("INSERT INTO hotel_moneda (codigo_moneda, desc_moneda, categoria_moneda)
    VALUES ('$codigo', '$moneda', '$categoria')");

  if($new) {
    actualizar_parametro('cont_moneda');
    echo 2;
  }

}
