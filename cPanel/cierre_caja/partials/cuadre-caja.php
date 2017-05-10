<section class="CuadreCaja white z-depth-1">
  <header>
    <h5 class="acent-text center-align no-margin">Cuadre de Caja</h5>
    <h6 class="acent-text center-align no-margin">Fecha: <?= $fecha_actual ?></h6>
    <div style="padding-bottom: .2em;margin: 9px 1em 1em 0;display: flex;justify-content: flex-end;">
      <button class="right-align btn waves-effect waves-light show-monedas">
        <i class="material-icons">add</i>
      </button>
      <button class="right-align btn waves-effect waves-light hide-monedas red darken-4"
        style="margin-left:1em;">
        <i class="material-icons">close</i>
      </button>
    </div>
  </header>
  <table class="responsive-table bordered">
    <thead>
      <tr>
        <th>Cant</th>
        <th>Moneda</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody id="arqueo_caja"></tbody>
    <tbody>
      <tr>
        <td></td>
        <td>Total $:</td>
        <td class="total_cuadre">0.00</td>
      </tr>
    </tbody>
  </table>
</section>
