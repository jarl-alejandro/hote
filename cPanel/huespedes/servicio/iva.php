<?php
include '../../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$fecha_actual = date("Y/m/d");

$id = $_POST["id"];
$iva = $_POST["iva"];

$pdo->query("UPDATE hotel_facturam SET iva_facturam='$iva' WHERE codigo_facturam='$id'");

print_r($_POST);