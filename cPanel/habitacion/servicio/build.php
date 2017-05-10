<?php
include '../../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$hoy = date("Y/m/d");
$codigo = $_POST["codigo"];
$value = $_POST["value"];

$query = $pdo->query("SELECT * FROM hotel_habitacion WHERE codigo_habitacion='$codigo'");

$row = $query->fetch();
$status = $row["estado_habitacion"];
$state = 5;

if($status == 5) {
  $state = 0;
  $pdo->query("INSERT INTO tmp_rep (tmp_hab, tmp_fech) VALUES ('$codigo', '$hoy')");
}
else{
  $pdo->query("INSERT INTO tmp_mant (tmp_hab, tmp_fech, tmp_obs)
              VALUES ('$codigo', '$hoy', '$value')");
}

$build = $pdo->query("UPDATE hotel_habitacion SET estado_habitacion='$state', obs_manten='$value', desde_fecha='$hoy'
  WHERE codigo_habitacion='$codigo'");


if($build) {
  echo 2;
}
