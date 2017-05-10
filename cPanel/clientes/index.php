<section>
  <article class="table">
  </article>
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
    <li><a class="btn-floating blue tooltipped" id="nuevo" data-position="left" data-delay="50" data-tooltip="Nuevo cliente"><i class="material-icons">mode_edit</i></a></li>
  </ul>
</div>
<?php include 'partials/alerta.php'; ?>
<?php include 'partials/alert-ingresar.php'; ?>
<?php include 'partials/alerta-desbloquear.php'; ?>
<script>
  $.getScript("clientes/static/js/componente.js")
</script>
