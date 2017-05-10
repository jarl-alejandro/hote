<link rel="stylesheet" href="restaurante/static/css/factura.css">
<style>
.Header-buscador{display:none;}
</style>
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
    <li><a class="btn-floating blue tooltipped" id="nuevo" data-position="left" data-delay="50" data-tooltip="Nueva Factura"><i class="material-icons">mode_edit</i></a></li>
  </ul>
</div>
<?php include 'partials/alerta.php'; ?>
<article class="FormaDePago z-depth-1 white radius col s9">
  <h4 class="FormaDePago-title center-align">Elige tu forma de pago</h4>
  <form>
    <h5 class="title-pago"><strong class="bagde-green">1</strong>Efectivo</h5>
    <div class="">
      <input class="with-gap input-dinner" name="pago" type="radio" id="efectivo" data-type="efectivo" />
      <label for="efectivo">$ <span class="cant-pay">0.00</span> USD</label>
    </div>
    <h5 class="title-pago"><strong class="bagde-green">2</strong>Deposito</h5>
    <div class="space-centrado">
      <div class="col s6">
        <input class="with-gap input-dinner" name="pago" type="radio" id="deposito" data-type="deposito" />
        <label for="deposito">$ <span class="cant-pay">0.00</span> USD</label>
      </div>
      <div class="input-field col s6 deposito-container">
        <input id="num_deposito" type="text" class="validate">
        <label for="num_deposito"># de deposito</label>
      </div>      
    </div>

    <div class="center-align">
      <button class="waves-effect waves-light btn color-toolbar" id="pagar-btn">Pagar</button>
      <button class="waves-effect waves-light btn red darken-3" id="cerrar-btn">Cerrar</button>
    </div>
  </form>
</article>
<script>
  $.getScript("restaurante/static/js/componente.js")
</script>
