<article class="HabitacionForm row white z-depth-1 u-none">
  <h5 class="HabitacionForm-title red darken-4 white-text center">Ingrese sus datos</h5>
  <div class="col s12" style="margin-top: 1em !important;">
    <div class="input-field col s4" style="margin-bottom: 1.5em !important;">
      <input id="adultos" type="text" class="validate" onkeypress="ValidaSoloNumeros()" maxlength="10" length="10">
      <label for="adultos" class="label-habitacion">Adultos</label>
    </div>
    <div class="input-field col s4">
      <input id="children" type="text" class="validate" onkeypress="ValidaSoloNumeros()" maxlength="10" length="10">
      <label for="children" class="label-habitacion">Niños</label>
    </div>
    <div class="input-field col s4">
      <span>Maximo de pesonas: </span>
      <span id="maxi_habitacion">2</span>
    </div>
  </div>
  </div>
  <p style="margin-top: 2em !important;text-align: center">
    <input type="checkbox" id="definido" />
    <label for="definido">Definir gastos maximos</label>
  </p>
  <article class="HabitacionForm-gastos u-none">
    <div class="input-field col s6" style="margin-left: 1em !important;">
      <input id="cant" type="text" class="validate" onkeypress="ValidaSoloNumeros()" maxlength="3" length="3">
      <label for="cant" class="label-habitacion">Cantidad</label>
    </div>
    <div class="input-field col s5" style="margin-left: 1em !important;top: 1em;">
      <input type="checkbox" id="indefinido" />
      <label for="indefinido">Indefenido</label>
    </div>
  </article>
  <div class="flex space" style="margin-bottom:1em !important">
    <button class="btn waves-effect waves-light red darken-3 cancelar-form">
      Cancelar
    </button>
    <button class="btn waves-effect waves-light color-toolbar" id="aceptar-form">
      Aceptar
    </button>
  </div>
</article>
