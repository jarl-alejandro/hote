<?php
include '../../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$total = $_POST["total"];
$devueltos = $_POST["devueltos"];
$codigo = $_POST["codigo"];

$pdo->query("UPDATE hotel_ventas SET total_venta='$total'
                WHERE codigo_venta='$codigo'");

// $hventaQuery = $pdo->query("SELECT codigo_facturam FROM hotel_ventas
//             WHERE codigo_venta='$codigo'");
//
// $ventFetch = $hventaQuery->fetch();
// $factCode = $ventFetch["codigo_facturam"];
//
// $pdo->query("UPDATE hotel_facturam SET total_facturam='$total'
//               WHERE codigo_facturam='$factCode'");

foreach ($devueltos as $devuelto) {
    $id = $devuelto["codigo"];
    $query = $pdo->query("SELECT * FROM detalle_ventas WHERE id_ventad='$id'");
    $ventas = $query->fetch();

    $cant = $ventas["cant_ventad"];
    $prod = $ventas["detalle_ventad"];

    $row_prdo = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$prod'");
    $prod_fetch = $row_prdo->fetch();

    $tipo_prod = $prod_fetch["tipo_producto"];
    $cant_prod = $prod_fetch["cantidad_producto"];
    $minimo_prod = $prod_fetch["minimo_producto"];
    $valor = $prod_fetch["valor_producto"];

    $total_cant = $cant_prod + $cant;

    $pdo->query("UPDATE hotel_producto SET cantidad_producto='$total_cant' WHERE codigo_producto='$prod'");

    $pdo->query("DELETE FROM detalle_ventas WHERE id_ventad='$id'");

    $kardex_query = $pdo->query("SELECT * FROM hotel_kardex WHERE codigo_producto='$prod'");
    $kardex = $kardex_query->fetch();
    $code_kardex = $kardex["codigo_kardex"];

    $detail_kardex = $pdo->query("SELECT * FROM detalle_kardex WHERE codigo_kardex='$code_kardex'
        ORDER BY id_detalle DESC LIMIT 1");

    $detail = $detail_kardex->fetch();
     $exist_cant = $detail["exist_cant"];
    $exist_val = $detail["exist_val"];
    $exist_sub = $detail["exist_sub"];

    $subt = $valor * $cant;

    $total_cant = $cant * $exist_val;

    $cantExist = $exist_cant + $cant;
    $valExist = ($exist_val + $valor) / 2;
    $subExist = $cantExist * $valExist;

    $detalle = "Devolucion de venta a la factura nro $codigo";

    $pdo->query("INSERT INTO detalle_kardex (codigo_kardex, desc_kardex, ent_cant, ent_val, ent_sub, sal_cant, sal_val, sal_sub, exist_cant, exist_val, exist_sub)
        VALUES ('$code_kardex', '$detalle', '$cant', '$valor', '$subt', '0', '0', '0', '$cantExist', '$valExist', '$subExist')");

  // Fin Kardex
}
print 2;
