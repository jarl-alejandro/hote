<?php
  $desde = $_GET["desde"];
?>
<?php
  session_start();
  date_default_timezone_set('America/Guayaquil');
  $fecha_actual = date("Y/m/d");
  $user = $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"];
?>
<header class="z-depth-1 white">
  <h4 class="acent-text center-align no-margin">Cierre de caja</h4>
  <h6 class="acent-text center-align no-margin">Fecha: <?= $desde ?></h6>
  <div style="padding-bottom: .2em;margin: 0 1em 1em 0;">
     <!--<h5 class="right-align acent-text">Empleado: <?= $user ?></h5>-->
  </div>
</header>
<table class="highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Nroº</th>
     <th data-field="Codigo">Codigo</th>
     <th data-field="Detalle">Detalle</th>
     <th data-field="total">total</th>
   </tr>
 </thead>
  <tbody class="white">
   <?php
   include '../../../bd/db.php';
  date_default_timezone_set('America/Guayaquil');
  // $fecha_actual = date("Y/m/d");

   $factura = $pdo->query("SELECT * FROM hotel_facturam WHERE factura_estado='pagado' 
      AND fecha_facturam='$desde'");
   
   $restaurante = $pdo->query("SELECT * FROM hotel_restaurante WHERE fecha_restaurante='$desde'");

   $egresos = $pdo->query("SELECT * FROM hotel_egreso WHERE fecha_egreso='$desde'");
   $mensuales = $pdo->query("SELECT * FROM v_pagos_mensuales WHERE mensual_fecha='$desde'");

   $count = 0;
   $total = 0;
   foreach ($factura as $row) : $count++; $total += $row["total_facturam"]; 
   ?>
    <tr>
      <td><?= $count ?></td>
      <td><?= $row["codigo_facturam"] ?></td>
      <td><?= $row["detealle_facturam"] ?></td>
      <td><?= $row["total_facturam"] ?></td>
    </tr>
   <?php endforeach ?>
   <?php foreach ($restaurante as $row) : $count++; $total += $row["total_restaurante"]; ?>
    <tr>
      <td><?= $count ?></td>
      <td><?= $row["codigo_restaurante"] ?></td>
      <td><?= $row["detalle_restaurante"] ?></td>
      <td><?= $row["total_restaurante"] ?></td>
    </tr>
   <?php endforeach ?>
   <?php foreach ($egresos as $row) : $count++; $total -= $row["valor_egreso"]; ?>
    <tr>
      <td><?= $count ?></td>
      <td><?= $row["codigo_egreso"] ?></td>
      <td><?= $row["referencia_egreso"] ?></td>
      <td><?= $row["valor_egreso"] ?></td>
    </tr>
   <?php endforeach;
   foreach($mensuales as $row): $count++; $total += $row["mensual_precio"];
   ?>
   <tr>
      <td><?= $count ?></td>
      <td><?= $row["mensual_reservacion"] ?></td>
      <td><?= "Pago mensual por ". $row["cliente"] ?></td>
      <td><?= $row["mensual_precio"] ?></td>
    </tr>
   <?php endforeach ?>   
   <tr>
     <td></td>
     <td></td>
     <td style="font-weight:bold;">TOTAL $: </td>
     <td style="font-weight:bold;" id="cierre_caja_total"><?= number_format($total, 2) ?></td>
   </tr>
  </tbody>
</table>

<button class="waves-effect waves-light btn btn-primary" id="CerrarFecha"
        style="margin-top:1em">Cerrar</button>

<script>
  $.getScript("cierra-parcial-fecha/static/js/actions.js")
</script>
