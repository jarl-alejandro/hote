<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Hacer Pedido</h3>
  </div>
  <form class="col s12 z-depth-1 white">
    <div class="input-field col s12 m9 offset-m1" style="margin-bottom:1.5em">
      <i class="material-icons prefix">description</i>
      <input id="descripcion" type="text" class="validate" maxlength="140" length="140">
      <label for="descripcion" class="field-label">Descripcion</label>
    </div>
    <a class="btn-floating btn-large waves-effect waves-light red darken-3 producto" style="margin-top: 1em;">
      <i class="material-icons">add</i>
    </a>

    <article class="col s10 offset-s1" style="margin-bottom: 2em;">
      <table class="bordered striped highlight responsive-table">
        <thead>
          <tr>
            <th data-field="codigo">Codigo</th>
            <th data-field="Producto">Producto</th>
            <th data-field="Cantidad">Cantidad</th>
            <th data-field="Valor">Valor</th>
            <th data-field="Precio">Precio</th>
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