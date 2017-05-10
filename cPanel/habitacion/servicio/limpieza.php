<?php
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$query = $pdo->query("SELECT * FROM hotel_habitacion WHERE codigo_habitacion='$codigo'");

$row = $query->fetch();
$status = $row["estado_habitacion"];
$state = 6;

if($status == 6) {
  $state = 0;
}

$build = $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='$state'
  WHERE codigo_habitacion='$codigo'");

if($build) {
  echo 2;
}
