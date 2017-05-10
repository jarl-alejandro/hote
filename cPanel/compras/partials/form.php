<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Compra</h3>
  </div>
  <form class="col s12 z-depth-1 white">
    <div class="input-field col s6">
      <i class="material-icons prefix">view_list</i>
      <input type="text" class="validate" id="factura" onkeypress="ValidaSoloNumeros()">
      <label for="factura" class="field-label">N° de factura</label>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">code</i>
      <select id="pedidos">
        <option value="" disabled selected>Elija su opción</option>
        <?php 
        include '../../bd/db.php';
        $pedidos = $pdo->query("SELECT * FROM hotel_pedidos");
        foreach ($pedidos as $prod): ?>
        <option value="<?= $prod['codigo_pedido'] ?>">
          <?= $prod['codigo_pedido'] ?>
        </option>
      <?php endforeach ?>
    </select>
    <label>Selecione la pedidos</label>
  </div>

  <article class="col s10 offset-s1" style="margin-bottom: 2em;">
    <table class="bordered striped responsive-table">
      <thead>
        <tr>
          <th style="width: 20%" data-field="codigo">Codigo</th>
          <th style="width: 50%" data-field="Producto">Producto</th>
          <th style="width: 10%" data-field="Cantidad">Cantidad</th>
          <th style="width: 10%" data-field="Valor">Valor</th>
          <th style="width: 10%" data-field="Precio">Precio</th>
        </tr>
      </thead>
      <tbody id="table_producto">
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
      <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td>Total: $</td>
        <td id="total_productos">0.00</td>
        <td></td>
      </tbody>
    </table> 
  </article>

  <div class="u-bottom-small flex space-between">
    <button class="btn waves-effect waves-light red darken-4 cancelar u-bottom-small">Cancelar
      <i class="material-icons right">close</i>
    </button>
    <button class="btn waves-effect waves-light guardar">Guardar
     <i class="material-icons right">send</i>
   </button>       
 </div>

</form>
</div>