<style>
/*.Layout{top:-2em;}*/
.form{
  top: 3em;
}
</style>
<link rel="stylesheet" href="facturas/static/css/factura.css">
<section>
  <article class="facturas-table">
  </article>
  <article class="form u-none row">
    <?php include 'partials/form.php'; ?>
  </article>
</section>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">attach_file</i>
  </a>
  <ul>
    <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Reporte General" id="reporteGeneral"><i class="material-icons">picture_as_pdf</i></a></li>
  </ul>
</div>
<?php include 'partials/alerta.php'; ?>
<script>
  $.getScript("devolucion_venta/static/js/componente.js")
</script>
