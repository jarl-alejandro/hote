<?php
include '../../../bd/db.php';
require('../../servicios/codigo.php');
date_default_timezone_set('America/Guayaquil');

$codigo = setCode('DS-', 8, 'hotel_desalojo', 'cont_desalojo');
$message = $_POST["message"];
$alquiler = $_POST["alquiler"];
$fecha_actual = date("Y/m/d");
$nuevafecha = strtotime( '+15 day' , strtotime($fecha_actual));
$nuevafecha = date('Y/m/d' , $nuevafecha); 
$estado = "avisado";

$new = $pdo->prepare("INSERT INTO hotel_desalojo (des_id, des_det, des_fet, des_alqui, des_est) 
                        VALUES (?, ?, ?, ?, ?)");

$new->bindParam(1, $codigo);
$new->bindParam(2, $message);
$new->bindParam(3, $nuevafecha);
$new->bindParam(4, $alquiler);
$new->bindParam(5, $estado);

$new->execute();

$pdo->query("UPDATE hotel_reservaciones SET aviso_estado='desalojado' WHERE codigo_reservacion='$alquiler'");

if($new) {
  actualizar_parametro('cont_desalojo');
  $response = array("status"=>201, "codigo"=>$codigo);
  print json_encode($response);
}