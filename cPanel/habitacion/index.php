<style>
  /*.Layout{top: 0em;}*/
</style>
<section>
  <article class="table"></article>
  <article class="form u-none">
    <?php include 'partials/form.php'; ?>
  </article>
</section>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">attach_file</i>
  </a>
  <ul>
    <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Reporte General" id="reporteGeneral"><i class="material-icons">picture_as_pdf</i></a></li>
    <li><a class="btn-floating blue tooltipped" id="nuevo" data-position="left" data-delay="50" data-tooltip="Nueva Habitación"><i class="material-icons">mode_edit</i></a></li>
  </ul>
</div>

<!-- Build -->
<div id="BuildModal" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="center-align">Mantenimiento</h4>
    <div class="input-field col s12">
      <textarea id="buildText" class="materialize-textarea"></textarea>
      <label for="buildText">Escriba una observacion del mantenimiento que se le realizara a la habitacion</label>
    </div>
  </div>
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" id="BuildButton">Mantenimiento</button>
    <button class="waves-effect waves-green btn red darken-4" id="CancelBuild">Cancelar</button>
  </div>
</div>
<h4 id="think">Habitación</h4>
<!-- /Build -->

<?php include 'partials/alerta.php'; ?>
<script>
  $.getScript("habitacion/static/js/componente.js")
</script>
