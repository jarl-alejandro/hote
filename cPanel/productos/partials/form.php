<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Registro de Productos y Servicios</h3>
  </div>
  <form class="col s12 z-depth-1 white">
    <input type="hidden" id="producto_id">
    <div class="row">
      <div class="col s12">
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">event_seat</i>
          <select id="tipo">
            <option value="" disabled selected>Elija su opción</option>
            <option value="producto">Producto</option>
            <option value="servicios">Servicio</option>
          </select>
          <label>Selecion un tipo</label>
        </div>
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">account_circle</i>
          <input id="nombre" type="text" class="validate" maxlength="140" length="140" onkeypress="txNombres()">
          <label for="nombre" class="field-label">Nombre del Producto/Servicio Ejemplo: Aguas</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="material-icons prefix">phone</i>
          <input id="valor" type="text" class="validate" maxlength="5" length="5" onkeypress="ValidaSoloDecimal()">
          <label for="valor" class="field-label">Valor del Producto/Servicio Ejemplo: 0.50</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="material-icons prefix">tablet_mac</i>
          <input id="cantidad" type="text" class="validate" maxlength="5" length="5" onkeypress="ValidaSoloNumeros()">
          <label for="cantidad" class="field-label">Cantidad del Producto/Servicio Ejemplo: 100</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="material-icons prefix">tablet_mac</i>
          <input id="maximo" type="text" class="validate" maxlength="5" length="5" onkeypress="ValidaSoloNumeros()">
          <label for="maximo" class="field-label">Maximo Ejemplo: 200</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="material-icons prefix">tablet_mac</i>
          <input id="minimo" type="text" class="validate" maxlength="5" length="5" onkeypress="ValidaSoloNumeros()">
          <label for="minimo" class="field-label">Minimo Ejemplo: 40</label>
        </div>
    </div>
  </div>
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