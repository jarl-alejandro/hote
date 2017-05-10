<?php
include '../bd/db.php';

if($_POST["iva"] != ""){

  $iva = $_POST["iva"];
  $familiar = $_POST["familiar"];
  $individual = $_POST["individual"];

  $update = $pdo->query("UPDATE hotel_parametro SET iva_hotel='$iva', desc_familiar='$familiar',
    desc_hotel='$individual' WHERE id_parametro=1");

  if($update){
    echo 2;
  }

}