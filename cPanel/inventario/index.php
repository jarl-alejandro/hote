<style>
  /*.Layout{top: 1em;}*/
</style>
<section>
  <div class="row">
    <div class="col s12" style="margin-bottom: 1em;">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#productos">Productos</a></li>
        <li class="tab col s3"><a href="#servicios">Servicios</a></li>
      </ul>
    </div>
    <div id="productos" class="col s12">
      <?php include 'partials/productos.php'; ?>
    </div>
    <div id="servicios" class="col s12">
      <?php include 'partials/servicios.php'; ?>
    </div>
  </div>
</section>
<script>
  $.getScript("inventario/static/js/componente.js")
</script>
