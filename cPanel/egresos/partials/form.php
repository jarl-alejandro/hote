<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Registro de Egreso</h3>
  </div>
  <form class="col s12 z-depth-1 white">
    <input type="hidden" id="egreso_id">

    <div class="input-field col s12 m9 offset-m1">
      <i class="material-icons prefix">description</i>
      <input id="referencia" type="text" class="validate" maxlength="140" length="140">
      <label for="referencia" class="field-label">Referencia Ejemplo: Pago de Luz</label>
    </div>

    <div class="input-field col s3 m3 offset-m1">
      <i class="material-icons prefix">attach_money</i>
      <input id="valor" type="text" class="validate" maxlength="5" length="5" onkeypress="ValidaSoloDecimal()">
      <label for="valor" class="field-label">Valor Ejemplo: 50</label>
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