<?php 
include '../../../bd/db.php';

$cedula = $_POST["cedula"];

$eliminar = $pdo->query("DELETE FROM hotel_cliente WHERE cedula_cliente='$cedula'");

if($eliminar) {
  echo 2;
}