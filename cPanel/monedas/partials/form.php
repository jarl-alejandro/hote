<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Registro de Moneda</h3>
  </div>
  <form class="col s12 z-depth-1 white">
    <input type="hidden" id="moneda_id">

    <div class="input-field col s4 offset-s1">
      <i class="material-icons prefix">attach_money</i>
      <input id="moneda" type="text" class="validate" maxlength="5" length="5"  onkeypress="ValidaSoloDecimal()">
      <label for="moneda" class="field-label">Moneda Ejemplo: 10</label>
    </div>

    <div class="input-field col s6">
      <select id="categoria">
        <option value="" disabled selected>Selecione tu opcion</option>
        <option value="Ctvs">Ctvs</option>
        <option value="Dolar">Dolar</option>
        <option value="Dolares">Dolares</option>
      </select>
      <label>Categoria</label>
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