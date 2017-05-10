<?php
session_start();

include '../../../bd/db.php';
require('../../servicios/codigo.php');

$cedula = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];
$pass = sha1($_POST["password"]);

$update = $pdo->query("UPDATE hotel_empleado SET password_empleado='$pass' WHERE cedula_empleado='$cedula'");
