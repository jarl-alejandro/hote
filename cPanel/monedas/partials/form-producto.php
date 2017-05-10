<?php
include '../../bd/db.php';

$codigo = $_GET["codigo"];
$prod = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$codigo'");
$producto = $prod->fetch();
?>
<article class="form row">
  <h3><?= $producto["nombre_producto"] ?></h3>
  <input type="hidden" class="codigo-producto-acabado" value="<?= $codigo ?>">
  <div class="input-field col s12">
    <input id="maximo-producto-acabado" type="text" class="validate" disabled value="<?= $producto["maximo_producto"] ?>">
    <label for="maximo-producto-acabado" class="active">Maximo</label>
  </div>
  <div class="input-field col s12">
    <input id="cant-producto-acabado" type="text" class="validate" onkeypress="ValidaSoloNumeros()"
    length="11" maxlength="11">
    <label for="cant-producto-acabado">Cantidad</label>
  </div>
  <div class="input-field col s12">
    <input id="minimo-producto-acabado" type="text" class="validate" disabled value="<?= $producto["minimo_producto"] ?>">
    <label for="minimo-producto-acabado" class="active">Minimo</label>
  </div>
  <div class="flex space">
    <button class="btn waves-effect waves-light red cancelar-acabados">Cancelar
      <i class="material-icons right">send</i>
    </button>
    <button class="btn waves-effect waves-light color-toolbar aceptar-acabados">Aceptar
      <i class="material-icons right">send</i>
    </button>
  </div>
</article>

<script>
  $('input, textarea').characterCounter();
  $(".cancelar-acabados").on("click", onCancelar)
  $(".aceptar-acabados").on("click", onAceptar)

  function validar() {
    var cant = $("#cant-producto-acabado")
    var maximo = $("#maximo-producto-acabado")
    var minimo = $("#minimo-producto-acabado")
    var flag = false

    if (cant.val() === "" || cant.val() == 0) {
      cant.focus()
      toast("Porfavor ingrese la cantidad")

    } else if(parseInt(maximo.val()) <= parseInt(cant.val())) {
      cant.focus()
      toast(`Porfavor la cantidad no puede execer o igual ${ maximo.val() }`)      

    } else if(cant.val() <= minimo.val()) {
      cant.focus()
      toast(`Porfavor la cantidad no puede ser menor o igual ${ minimo.val() }`)      

    } else flag = true

    return flag
  }

  function onAceptar () {
    var cant = $("#cant-producto-acabado")
    var codigo = $(".codigo-producto-acabado")

    if (validar()) {
      $.ajax({
        type:"POST",
        url:"servicios/acabados.php",
        data:{ cant:cant.val(), codigo:codigo.val() }
      })
      .done(function (data) {
        if(data == 2) {
          onCancelar()
          $(".Notificaciones").load('partials/acabados.php')
        } else {
          console.log(data)
        }

      })
    }
  }

  function onCancelar () {
    $(".u-oculto").slideUp()
    $(".FormProductoAcabados").slideUp()      
  }
</script>