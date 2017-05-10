<?php
session_start();
include '../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$user = $_POST["user"];
$pass = sha1($_POST["pass"]);
$fecha_actual = date("Y-m-d");

$count_empleado = $pdo->query("SELECT * FROM hotel_empleado WHERE cedula_empleado='$user' AND password_empleado='$pass'");
$count_socio = $pdo->query("SELECT * FROM hotel_cliente WHERE cedula_cliente='$user' AND password_cliente='$pass'");

if($count_empleado->rowCount() == 0){

  if ($count_socio->rowCount() == 0) {
    echo 1;
    return false;

  } else {
    $socio = $count_socio->fetch();
    $username = $socio['nombre_cliente'] . " " . $socio['apellido_cliente'];

    $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"] = $socio['cedula_cliente'];
    $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"] = $username;
    $_SESSION["a88b7dcd1a9e3e17770bbaa6d7515b31a2d7e85d"] = $socio['email_cliente'];
    $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"] = "socio";
    echo 2;
    header("Location: habitaciones.php");
    return false;
  }

  echo 1;
  return false;

} else {
  $empleado = $count_empleado->fetch();

  if($empleado["estado_empleado"] == "bloqueado" && $empleado["fecha_bloqueado"] == $fecha_actual){
    echo 3;
    return false;
  }
  else {
    $cedula = $empleado['cedula_empleado'];
    $pdo->query("UPDATE hotel_empleado SET estado_empleado='' WHERE cedula_empleado='$cedula'");

    $username = $empleado['nombre_empleado']. " " .$empleado['apellido_empleado'];

    $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"] = $cedula;
    $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"] = $username;
    $_SESSION["a88b7dcd1a9e3e17770bbaa6d7515b31a2d7e85d"] = $empleado['email_empleado'];
    $_SESSION["a31220bbe4802f5451332e38ef5c879ca5f0e91a"] = $empleado['avatar_empleado'];
    $_SESSION["e0d6ae5cf2a2d0c1075943593a36cc5377382a05"] = $empleado['cargo_empleado'];
    $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"] = "empleado";

    echo 2;
    return false;
  }
}
