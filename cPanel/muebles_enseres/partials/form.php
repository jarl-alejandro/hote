<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Registro De Mubles Y Enseres</h3>
  </div>
  <form class="col s12 z-depth-1 white">
    <input type="hidden" id="muebles_id">
    <div class="input-field col s8 m6 offset-m1">
      <i class="material-icons prefix">code</i>
      <input id="desc" type="text" class="validate" maxlength="100" length="100" onkeypress="txNombres()">
      <label for="desc" class="field-label">Mubles Y Enseres Ejemplo: cama</label>
    </div>

    <div class="input-field col s3 m3">
      <i class="material-icons prefix">format_list_numbered</i>
      <input id="vida" type="text" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloNumeros()">
      <label for="vida" class="field-label">Vida util 10</label>
    </div>

    <div class="input-field col s12 m5 offset-m1" style="margin-bottom:1.5em">
      <i class="material-icons prefix">description</i>
      <input id="precio" type="text" class="validate" maxlength="5" length="5"
          onkeypress="ValidaSoloDecimal()">
      <label for="precio" class="field-label">Precio Ejemplo: 10.50</label>
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
