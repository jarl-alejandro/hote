<?php 

function setCode($letra=NULL, $digitos=NULL, $tabla=NULL, $fila){
  include '../../../bd/db.php';

  $query = $pdo->query("SELECT * FROM hotel_parametro");
  $row = $query->fetch();
  $cant = $row[$fila];
  $str_ceros = "";

  $nletra = strlen($letra);
  $ncant = strlen($cant);

  $ceros = $digitos - ($nletra + $ncant); 
  $i = 1;

  while($i <= $ceros){
    $str_ceros .= "0";
    $i += 1; 
  }

  $cant++;
  $codigo = $letra.$str_ceros.$cant; 
  return $codigo;
}

function actualizar_parametro ($campo) {
  include '../../../bd/db.php';
  
  $query1 = $pdo->query("SELECT * FROM  hotel_parametro");
  $row1 = $query1->fetch();
  $canta = $row1[$campo];
  $canta++;

  $update1 = "UPDATE hotel_parametro SET $campo='$canta++' WHERE id_parametro=1 LIMIT 1";
  $update_params1 = $pdo->query($update1);
}