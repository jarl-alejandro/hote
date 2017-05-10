<section class="col s9">
  <header class="FacturaHeader white z-depth-1 row">
    <div class="col s8 u-flex-centerV">
      <div class="input-field col s12 m10 u-no_margin__top" style="margin-left:0;padding-left:0">
        <input disabled id="habitacion" type="text" class="validate u-no_margin__bottom">
        <input type="hidden" id="habitacion_codigo" />
        <input type="hidden" id="habitacion_cant" />
        <label for="habitacion" class="disabled-active">Habitacion</label>
      </div>
    </div>
    <div class="input-field col s12 m4 u-no_margin__top">
      <input disabled id="fecha" type="text" class="validate u-no_margin__bottom" value="<?= date("Y/m/d") ?>">
      <label for="fecha" class="active">Fecha</label>
    </div>
    <div class="input-field col s12 m8">
      <input id="detalle" class="validate" type="text" />
      <label for="detalle" class="detail_label">Detalle</label>
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
          <td style="10%;font-weight:bold">Total $</td>
          <td style="10%;font-weight:bold" class="total_factura">0.00</td>
        </tr>
      </tbody>
    </table>
    <div class="flex space" style="padding:1em 0;">
      <button class="btn red darken-4 waves-effect waves-light cancelar-factura">Cancelar 
        <i class="material-icons right">clear</i>
      </button>
    </div>
  </article>
</section>