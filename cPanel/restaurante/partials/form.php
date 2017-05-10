<?php 
  include '../../bd/db.php';

  $queryPram = $pdo->query("SELECT * FROM hotel_parametro WHERE id_parametro='1'");
  $params = $queryPram->fetch();
?>
<section class="col s9">
  <header class="FacturaHeader white z-depth-1 row">
    <div class="col s8 u-flex-centerV">
      <div class="input-field col s12 m10 u-no_margin__top" style="margin-left:0;padding-left:0">
        <input id="cliente" type="text" class="validate u-no_margin__bottom" maxlength="1" length="1"
          onkeypress="ValidaSoloPunto()">
        <label for="cliente" class="disabled-active">Cliente</label>
      </div>

      <div class="input-field col s12 m10 u-no_margin__top" style="margin-left:0;padding-left:0">
        <input id="nombre" type="text" class="validate u-no_margin__bottom" maxlength="1" length="1"
          onkeypress="ValidaSoloPunto()" disabled>
        <label for="nombre" class="disabled-active">Nombre Completo</label>
      </div>
      
      <button class="waves-effect waves-light btn color-acent show-clientes">
        <i class="material-icons">add</i>
      </button>
    </div>
    <div class="input-field col s12 m4 u-no_margin__top">
      <input disabled id="fecha" type="text" class="validate u-no_margin__bottom" value="<?= date("Y/m/d") ?>">
      <label for="fecha" class="active">Fecha</label>
    </div>
    <div class="col s6">
      <div class="input-field col s12 u-no_margin__top" style="margin-left:0;padding-left:0">
        <input disabled id="direccion" type="text" class="validate u-no_margin__bottom" />
        <label for="direccion" class="active">Direccion</label>
      </div>
    </div>
    
    <div class="col s6">
      <div class="input-field col s12 u-no_margin__top">
        <select id="desc-select">
          <option value="0">Nigun descuento</option>
          <option value="<?= $params['desc_familiar'] ?>">Descuento familiar</option>
          <option value="<?= $params['desc_hotel'] ?>">Descuento individual</option>
        </select>
        <!--<label for="desc-select" class="active">Descuento</label>-->
      </div>
    </div>

    <div class="col s2" style="margin-bottom: 1em;float: right">
      <button class="btn color-acent waves-effect waves-light productos" disabled>
        <i class="material-icons prefix">local_bar</i>
      </button>
    </div>
  </header>
  <article class="FacturaBody white z-depth-1">
    <table class="table striped centered bordered">
      <thead class="color-acent white-text">
        <tr>
          <th style="width:10%">Cant</th>
          <th style="width:70%">Detalle</th>
          <th style="width:10%">V. Unit</th>
          <th style="width:10%">V. Total</th>
        </tr>
      </thead>
      <tbody id="facturat_tbody"></tbody>
      <tbody>
        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">Subtotal $</td>
          <td style="10%;font-weight:bold" id="subTotal_factura">0.00</td>
        </tr>
        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">IVA <span id="iva-params"><?=$params["iva_hotel"]?></span>%</td>
          <td style="10%;font-weight:bold" id="iva-factura">0.00</td>
        </tr>
        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">DESC <span id="porcent-desc">0</span>%</td>
          <td style="10%;font-weight:bold" id="desc-factura">0.00</td>
        </tr>
        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">Total $</td>
          <td style="10%;font-weight:bold" class="total_factura">0.00</td>
        </tr>
      </tbody>
    </table>
    <div class="flex space" style="padding:1em 0;">
      <button class="btn red darken-4 waves-effect waves-light cancelar-factura">Cancelar 
        <i class="material-icons right">clear</i>
      </button>
      <button class="btn color-toolbar waves-effect waves-light aceptar-factura">Aceptar
        <i class="material-icons right">send</i>
      </button>
    </div>
  </article>
  <?php
  include 'partials/clientes.php'; 
  include 'partials/productos.php'; 
  ?>
</section>