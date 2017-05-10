<?php
include '../../../bd/db.php';

$id = $_POST["id"];

$desalojo = $pdo->query("DELETE FROM hotel_desalojo WHERE des_alqui='$id'");
$pdo->query("UPDATE hotel_reservaciones SET aviso_estado='' WHERE codigo_reservacion='$id'");

if($desalojo){
  echo 2;
}