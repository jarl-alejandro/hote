<?php
$factura = $pdo->query("SELECT SUM(total_facturam) as 'total' FROM hotel_facturam
    WHERE factura_estado='pagado' GROUP BY factura_estado");

$restaurante = $pdo->query("SELECT SUM(total_restaurante) AS 'total' FROM hotel_restaurante");
$egreso = $pdo->query("SELECT SUM(valor_egreso) as 'total' FROM hotel_egreso");
$mensuales = $pdo->query("SELECT SUM(mensual_precio) as 'total' FROM v_pagos_mensuales");

$total_factura = $factura->fetch();
$total_restaurante = $restaurante->fetch();
$total_egreso = $egreso->fetch();
$total_mensuales = $mensuales->fetch();

$egreso = $total_egreso["total"];
$total_ingreso = $total_factura["total"] + $total_restaurante["total"] + $total_mensuales["total"];
$total = ($total_ingreso - $egreso);

if($total < 0) {?>
<style>
  .totales{
    background: #F44336 !important;
  }
</style>
<?php }
?>
<div class="seccion-estadistica">
    <div class="ingresos z-depth-1"><?= number_format($total_ingreso, 2) ?></div>
    <p class="signo">-</p>
    <div class="egresos z-depth-1"><?= number_format($egreso, 2) ?></div>
    <p class="signo">=</p>
    <div class="totales z-depth-1"><?= number_format($total,2) ?></div>
</div>

<div class="valores-estadistica">
  <div class="valores__item">
    <div class="red-val"></div>
    <label>Saldo deudor</label>
  </div>
  <div class="valores__item">
    <div class="blue-val"></div>
    <label>Saldo acreedor</label>
  </div>
</div>
