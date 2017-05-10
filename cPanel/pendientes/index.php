<?php 
  date_default_timezone_set('America/Guayaquil');
  $fecha = date("Y-m-d");
?>
<style>
  /*.Layout{top: 2em;}*/
</style>
<section>
  <article class="table"></article>
</section>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">attach_file</i>
  </a>
  <ul>
    <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Reporte General" id="reporteGeneral"><i class="material-icons">picture_as_pdf</i></a></li>
    <li><a class="btn-floating blue-gray darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Por Fecha" id="porfecha"><i class="material-icons">alarm</i></a></li>
  </ul>
</div>

<section class="RotacionFecha white z-depth-1">
  <h5 class="acent-text center-align no-margin" style="margin-bottom:.5em;">Pendientes Por Fecha</h5>
  <div class="row">
    <div class="input-field col s6">
      <input type="date" class="datepicker" id="hasta" max="<?= $fecha ?>">
      <label for="hasta" class="active">Hasta</label>
    </div>
    <div class="input-field col s6">
      <input type="date" class="datepicker" id="desde" min="<?= $fecha ?>">
      <label for="desde" class="active">Desde</label>
    </div>
  </div>
  <div class="flex space" style="margin-bottom:.5em;">
    <button class="btn waves-effect waves-light pendiente_cerrar red darken-3">Cerrar</button>
    <button class="btn waves-effect waves-light pendiente_aceptar color-toolbar">Aceptar</button>
  </div>
</section>
<?php include 'partials/alert-ingresar.php'; ?>
<script>
  $.getScript("pendientes/static/js/componente.js")
</script>
