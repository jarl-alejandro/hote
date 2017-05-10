<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Registro de empleado</h3>
  </div>
  <form class="col s12 z-depth-1 white">
    <input type="hidden" id="cedula_id">
    <div class="input-field col s12 m6">
      <i class="material-icons prefix">credit_card</i>
      <input id="cedula" type="text" class="validate" maxlength="13" length="13" onkeypress="ValidaSoloNumeros()">
      <label for="cedula" class="field-label">Cedula/RUC Ejemplo: 1718760281</label>
    </div>

    <div class="input-field col s12 m6">
      <i class="material-icons prefix">account_circle</i>
      <input id="nombre" type="text" class="validate" maxlength="140" length="140" onkeypress="txNombres()">
      <label for="nombre" class="field-label">Nombre Ejemplo: Juan</label>
    </div>

    <div class="input-field col s12 m6">
      <i class="material-icons prefix">person</i>
      <input id="apellido" type="text" class="validate" maxlength="140" length="140" onkeypress="txNombres()">
      <label for="apellido" class="field-label">Apellido Ejemplo: Zambrano</label>
    </div>

    <div class="input-field col s12 m6">
      <i class="material-icons prefix">email</i>
      <input id="email" type="email" class="" maxlength="140" length="140">
      <label for="email" class="field-label" data-error="E-mail incorrecto" data-success="E-mail correcto">Email Ejemplo: pepe@gmail.com</label>
    </div>

    <div class="input-field col s12 m6">
      <i class="material-icons prefix">phone</i>
      <input id="telefono" type="tel" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloNumeros()">
      <label for="telefono" class="field-label">Telefono (Opcional) Ejemplo: 023767837</label>
    </div>

    <div class="input-field col s12 m6">
      <i class="material-icons prefix">tablet_mac</i>
      <input id="celular" type="tel" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloNumeros()">
      <label for="celular" class="field-label">Celular Ejemplo: 0993678637</label>
    </div>

    <div class="input-field col s12 m6">
      <i class="material-icons prefix">my_location</i>
      <input id="direccion" type="tel" class="validate" maxlength="140" length="140">
      <label for="direccion" class="field-label">Direccion Ejemplo: El carmen</label>
    </div>

    <div class="input-field col s12 m6">
      <i class="material-icons prefix">event_seat</i>
     <select id="cargo">
       <option value="" disabled selected>Selecione</option>
       <option value="administrador">Administrador</option>
       <option value="contador">Contador</option>
       <option value="vendedor">Vendedor</option>
       <option value="recepcionista">Recepcionista</option>
     </select>
     <label>Selecion un cargo</label>
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