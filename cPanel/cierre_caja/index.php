<?php 
  date_default_timezone_set('America/Guayaquil');
  $fecha_actual = date("Y/m/d");
   include '../../bd/db.php';
  ?>
<section class="row">
  <article class="table col s9 offset-m2"></article>
  <div class="flex space col s9 offset-m2" style="margin-top:1em">
    <button class="btn waves-effect waves-light cuadre-caja">Cuadre de Caja</button>
    <button class="btn waves-effect waves-light cierre-parcial">Cierre Parcial</button>
    <button class="btn waves-effect waves-light aceptar-cierre">Aceptar</button>
  </div>
</section>
<?php include 'partials/cuadre-caja.php'; ?>
<?php include 'partials/monedas.php'; ?>
<?php include 'partials/alert-ingresar.php'; ?>
<script>
  $.getScript("cierre_caja/static/js/componente.js")
</script>
