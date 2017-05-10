<style>
  .Layout{width: 95%;}
</style>
<style>.Header-buscador{display:none;}</style>
<section>
  <article class="table_bajo"></article>
  <article class="form u-none">
    <?php include 'partials/form.php'; ?>
  </article>
  <article class="productos-list">
    <?php include 'partials/productos.php'; ?>
  </article>
</section>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">attach_file</i>
  </a>
  <ul>
    <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Reporte General" id="reporteGeneral"><i class="material-icons">picture_as_pdf</i></a></li>
    <li><a class="btn-floating blue tooltipped" id="nuevo" data-position="left" data-delay="50" data-tooltip="Hacer pedido"><i class="material-icons">mode_edit</i></a></li>
  </ul>
</div>
<?php include 'partials/alerta.php'; ?>
<script>
  $.getScript("pedidos/static/js/componente.js")
</script>
