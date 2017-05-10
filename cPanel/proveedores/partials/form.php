<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Registro de Proveedor</h3>
  </div>
  <form class="col s12 z-depth-1 white">
    <input type="hidden" id="proveedor_id">
    <div class="row">
      <div class="col s12 m6">
        <!-- Informacion del proveedor -->
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="nombre" type="text" class="validate" maxlength="140" length="140" onkeypress="txNombres()">
          <label for="nombre" class="field-label">Nombre del Proveedor Ejemplo: Jet</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="email" type="email" class="" maxlength="140" length="140">
          <label for="email" class="field-label" data-error="E-mail incorrecto" data-success="E-mail correcto">Email del Proveedor Ejemplo: jet@mail.com</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">phone</i>
          <input id="telefono" type="tel" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloNumeros()">
          <label for="telefono" class="field-label">Telefono del Proveedor (Opcional)
          Ejemplo: 023766543</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">tablet_mac</i>
          <input id="celular" type="tel" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloNumeros()">
          <label for="celular" class="field-label">Celular del Proveedor Ejemplo: 0937363522</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">my_location</i>
          <input id="direccion" type="tel" class="validate" maxlength="140" length="140">
          <label for="direccion" class="field-label">Direccion del Proveedor
          Ejemplo: Quito</label>
        </div>
        <!-- Fin Informacion del proveedor -->
      </div>
      <div class="col s12 m6">
        <!-- Informacion del contacto -->
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="nombreContacto" type="text" class="validate" maxlength="140" length="140" onkeypress="txNombres()">
          <label for="nombreContacto" class="field-label">Nombre del Contacto Ejemplo: Pepe Villalobos</label>
        </div>


        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="emailContacto" type="email" class="" maxlength="140" length="140">
          <label for="emailContacto" class="field-label" data-error="E-mail incorrecto" data-success="E-mail correcto">Email del Contacto Ejemplo: pepe@gmail.com</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">phone</i>
          <input id="telefonoContacto" type="tel" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloNumeros()">
          <label for="telefonoContacto" class="field-label">Telefono del Contacto (Opcional)
           Ejemplo: 034349349</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">tablet_mac</i>
          <input id="celularContacto" type="tel" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloNumeros()">
          <label for="celularContacto" class="field-label">Celular del Contacto Ejemplo: 09937362833</label>
        </div>
        <!-- Fin Informacion del contacto -->
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