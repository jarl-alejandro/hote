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
<?php include 'partials/alerta.php'; ?>
<script>
  $.getScript("anular_venta/static/js/componente.js")
</script>
