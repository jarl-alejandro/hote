<?php
  include '../bd/db.php';

  $query = $pdo->query("SELECT * FROM hotel_parametro WHERE id_parametro=1");
  $params = $query->fetch();
?>
<div id="modal-parametros" class="modal modal-fixed-footer" style="height: 21em;">
  <div class="modal-content">
    <h4 style="text-align:center;color:white;" class="color-toolbar">Parámetros</h4>
    
    <div class="row">
      <div class="input-field col s12">
        <input id="iva" type="text" class="validate" maxlength="2" onkeypress="ValidaSoloNumeros()"
          value="<?= $params['iva_hotel'] ?>">
        <label for="iva">IVA</label>
      </div>
      <div class="input-field col s6">
        <input id="desc-familiar" type="text" class="validate" maxlength="2" onkeypress="ValidaSoloNumeros()"
           value="<?= $params['desc_familiar'] ?>">
        <label for="desc-familiar">Descuento Familiar</label>
      </div>
      <div class="input-field col s6">
        <input id="desc-indivi" type="text" class="validate" maxlength="2" onkeypress="ValidaSoloNumeros()"
          value="<?= $params['desc_hotel'] ?>">
        <label for="desc-indivi">Descuento Individual</label>
      </div>
    </div>

    <div class="col s12" style="display: flex;justify-content: center;">
      <button class="waves-effect waves-green btn" id="acept-params">Aceptar</button>
    </div>

  </div>
</div>

<script>
;(function (){
  $("#acept-params").on("click", handleAceptParams)

  var $iva = $("#iva")
  var $familiar = $("#desc-familiar")
  var $individual = $("#desc-indivi")

  function handleAceptParams (e) {
    e.preventDefault()
    if(validarParams()){
      $.ajax({
        type: "POST",
        url: "./actualizar-parametros.php",
        data: { iva: $iva.val(), familiar: $familiar.val(), individual: $individual.val() }
      })
      .done(function (snap) {
        console.log(snap)
        if(snap == 2) {
          $("#modal-parametros").slideUp()
          toast("Se ha actualizado con exito los parametros")
        }
      })
    }
  }

  function validarParams (){
    if($iva.val() == "" || $iva.val() == 0){
      toast("Debe ingresar el iva")
      $iva.focus()
      return false
    }
    if($familiar.val() == "" || $familiar.val() == 0){
      toast("Debe ingresar el descuento familiar")
      $familiar.focus()
      return false
    }
    if($individual.val() == "" || $individual.val() == 0){
      toast("Debe ingresar el descuento individual")
      $individual.focus()
      return false
    }
    else return true
  }
})()
</script>