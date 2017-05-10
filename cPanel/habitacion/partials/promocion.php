<article class="Promocion white z-depth-1">
  <h4 class="acent-text no-margin center-align">Promoción</h4>
  <div class="row">
    <div class="input-field col s10 offset-s1">
      <input id="description-promo" class="validate" type="text" maxlength="140" length="140" />
      <label for="description-promo">Descripcion</label>
    </div>
    <div class="input-field col s5 offset-s1">
      <input id="descuento-promo" class="validate" type="text" maxlength="2" length="2" 
        onkeypress="ValidaSoloNumeros()" />
      <label for="descuento-promo">Descuento</label>
    </div>
  </div>
  <div class="flex space" style="margin-bottom: 1em;">
    <button class="btn waves-effect waves-light red darken-4 promocion-cancelar">Cancelar
      <i class="material-icons right">close</i>
    </button>
    <button class="btn waves-effect waves-light color-toolbar promocion-btn">Promocionar
      <i class="material-icons right">send</i>
    </button>
  </div>
</article>