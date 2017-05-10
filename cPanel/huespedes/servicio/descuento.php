<?php
include '../../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$fecha_actual = date("Y/m/d");

$id = $_POST["id"];
$desc = $_POST["desc"];
$tipo = $_POST["tipo"];

$pdo->query("UPDATE hotel_facturam SET desc_facturam='$desc', desc_tipo='$tipo' 
            WHERE codigo_facturam='$id'");

print_r($_POST);
