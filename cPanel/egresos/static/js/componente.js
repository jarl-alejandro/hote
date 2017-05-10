;(function (){
	'use strict'

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('egresos/partials/table.php')

  var $nuevo = $("#nuevo")
  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $reporteGeneral = $("#reporteGeneral")
  var $confirmEgreso = $("#confirmEgreso")

  // Inputs
  var $referencia = $("#referencia")
  var $valor = $("#valor")

  // Utilidades

  function u_formulario () {
    limpiar()
    $(".table").load('egresos/partials/table.php')
    $(".table").slideDown()
    $(".form").slideUp()
    $(".Alerta").slideUp()
    $(".u-oculto").fadeOut()
    $confirmEgreso.attr("disabled", false)
  }

  function limpiar () {
    $referencia.val("")
    $valor.val("")
    $("#egreso_id").val("")
    $(".valid").removeClass("valid")
    $("label.active").removeClass("active")
    $(".guardar").attr("disabled", false)
  }

  function getData () {
    return {
      id:$("#egreso_id").val(),
      referencia:$referencia.val(),
      valor:$valor.val()
    }
  }

  // Validaciones
  function validarFormulario() {
    var flag = false

    if ($referencia.val() === "" || $referencia.val() === "0") {
      $referencia.focus()
      toast("Porfavor ingresar una referencia")

    } else if ($valor.val() === "" || /^\s*$/.test($valor.val())) {
      $valor.focus()
      toast("Porfavor ingrese el valor del pago")

    } else flag = true

    return flag
  }

  // Eventos

  function onCancelar (e) {
    e.preventDefault()
    limpiar()
    $(".table").slideDown()
    $(".form").slideUp()
  }
  function onGuardar (e) {
    e.preventDefault()

    if (validarFormulario()) {
      $(".Alerta").slideDown()
      $(".u-oculto").fadeIn()
    }
  }

  function saveEgreso (){
    $confirmEgreso.attr("disabled", true)    
    $.ajax({
      type:"POST",
      url:"egresos/servicio/guardar.php",
      data: getData()
    })
    .done(function (data) {
      console.log(data)
      if(data == 2) {
        toast("Se ha registrado con exito.")
        u_formulario()
      } else if (data == 20) {
        toast("Se ha actualizado con exito.")
        u_formulario()
      } else if(data == 1) {
        toast("Porfavor actualizado los parametros")
        $cedula.focus()
      } 

    })
  }

  function onNuevo () {
    $(".table").slideUp()
    $(".form").slideDown()
  }

  function reporteGeneral() {
    window.open (`./egresos/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $nuevo.on("click", onNuevo)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)
  $reporteGeneral.on("click", reporteGeneral)
  $confirmEgreso.on("click", saveEgreso)

})()
