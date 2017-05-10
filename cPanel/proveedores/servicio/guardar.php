<?php 
include '../../../bd/db.php';
require('../../servicios/codigo.php');

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$celular = $_POST["celular"];
$direccion = $_POST["direccion"];

$nombreContacto = $_POST["nombreContacto"];
$emailContacto = $_POST["emailContacto"];
$telefonoContacto = $_POST["telefonoContacto"];
$celularContacto = $_POST["celularContacto"];
$codigo = setCode('PR-', 8, 'hotel_proveedor', 'cont_proveedor');

if($id != "") {
  $update = $pdo->query("UPDATE hotel_proveedor SET nombre_proveedor='$nombre', email_proveedor='$email', telefono_proveedor='$telefono', celular_proveedor='$celular', direccion_proveedor='$direccion', nombre_contacto='$nombreContacto', email_contacto='$emailContacto', telefono_contacto='$telefonoContacto', celular_contacto='$celularContacto' WHERE codigo_proveedor='$id'");

  if($update) {
    echo 20;
  }

} else {
  $row = $pdo->query("SELECT * FROM hotel_proveedor WHERE codigo_proveedor='$codigo'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new = $pdo->query("INSERT INTO hotel_proveedor (codigo_proveedor, nombre_proveedor, email_proveedor, telefono_proveedor, celular_proveedor, direccion_proveedor, nombre_contacto, email_contacto, telefono_contacto, celular_contacto)
    VALUES ('$codigo', '$nombre', '$email', '$telefono', '$celular', '$direccion', '$nombreContacto', '$emailContacto',
     '$telefonoContacto', '$celularContacto')");

  if($new) {
    actualizar_parametro('cont_proveedor');
    echo 2;
  }
  
}
