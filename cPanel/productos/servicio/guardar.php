<?php 
include '../../../bd/db.php';
require('../../servicios/codigo.php');

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$valor = $_POST["valor"];
$cantidad = $_POST["cantidad"];
$tipo = $_POST["tipo"];
$maximo = $_POST["maximo"];
$minimo = $_POST["minimo"];

$codigo = setCode('PS-', 8, 'hotel_producto', 'cont_producto');
$code = setCode('KA-', 8, 'hotel_kardex', 'cont_kardex');

if($id != "") {
  $update = $pdo->query("UPDATE hotel_producto SET nombre_producto='$nombre', valor_producto='$valor', cantidad_producto='$cantidad', tipo_producto='$tipo', maximo_producto='$maximo', minimo_producto='$minimo' WHERE codigo_producto='$id'");

  if($update) {
    echo 20;
  }

} else {
  $row = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$codigo'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new = $pdo->query("INSERT INTO hotel_producto (codigo_producto, nombre_producto, valor_producto, cantidad_producto, tipo_producto, maximo_producto, minimo_producto)
    VALUES ('$codigo', '$nombre', '$valor', '$cantidad', '$tipo', '$maximo', '$minimo')");

  $pdo->query("INSERT INTO hotel_kardex (codigo_kardex, codigo_producto)
    VALUES ('$code', '$codigo')");

  $subt = $valor * $cantidad;

  $pdo->query("INSERT INTO detalle_kardex (codigo_kardex, desc_kardex, ent_cant, ent_val, ent_sub, sal_cant, sal_val, sal_sub, exist_cant, exist_val, exist_sub)
    VALUES ('$code', 'Inventario Inicial', '0', '0', '0', '0', '0', '0', '$cantidad', '$valor', '$subt')");

  if($new) {
    actualizar_parametro('cont_producto');
    actualizar_parametro('cont_kardex');
    echo 2;
  }
  
}
