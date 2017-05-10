<?php 
include '../../bd/db.php';
?>
<style>
  .Layout{
    /*top: -6em;*/
  }
</style>
<section>
  <div class="row">
    <div class="col s12" style="margin-bottom: 1em;">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#ingresos">Ingresos</a></li>
        <li class="tab col s3"><a href="#egresos">Egresos</a></li>
        <li class="tab col s3"><a href="#totales">Totales</a></li>
        <li class="tab col s3"><a href="#depositos">Depositos</a></li>
      </ul>
    </div>
    <div id="ingresos" class="col s12">
      <?php include 'partials/ingresos.php'; ?>
    </div>
    <div id="egresos" class="col s12">
      <?php include 'partials/egresos.php'; ?>
    </div>
    <div id="totales" class="col s12">
      <?php include 'partials/totales.php'; ?>
    </div>
    <div id="depositos" class="col s12">
      <?php include 'partials/depositos.php'; ?>
    </div>
  </div>
</section>
<script>
  $.getScript("estadisticas/static/js/componente.js")
</script>
