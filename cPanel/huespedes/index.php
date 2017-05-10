<style>
  /*.Layout{top: -2em;}*/
</style>

<section>
  <article class="table-huesped"></article>
  <article class="form u-none"></article>
</section>
<article class="z-depth-1 white radius col s7" id="ModalSalir">
  <header class="modal-salir__header blue">
    <h2 class="center-align white-text darekn-2">Salir de la habiatcion</h2>
  </header>
  <div class="modal-salir__body">
    <div class="row">
      <div class="input-field col s12">
        <textarea id="messageDesalojo" class="materialize-textarea"></textarea>
        <label for="messageDesalojo">Escriba el mensaje de desalojo</label>
      </div>
    </div>
    <div class="center-align">
      <button class="waves-effect waves-light btn color-toolbar" id="aceptarSalir">Aceptar</button>
      <button class="waves-effect waves-light btn red darken-2" id="cerrarSalir">Cerrar</button>
    </div>
    
  </div>
</article>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">attach_file</i>
  </a>
  <ul>
    <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Reporte General" id="reporteGeneral"><i class="material-icons">picture_as_pdf</i></a></li>
  </ul>
</div>
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
<?php include 'partials/alerta.php'; ?>
<script>
  $.getScript("huespedes/static/js/componente.js")
</script>
