;(function (){
	'use strict'

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('monedas/partials/table.php')
  $('select').material_select();

  var $nuevo = $("#nuevo")
  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $reporteGeneral = $("#reporteGeneral")

  // Inputs
  var $moneda = $("#moneda")
  var $categoria = $("#categoria")

  // Utilidades

  function u_formulario () {
    limpiar()
    $(".table").load('monedas/partials/table.php')
    $(".table").slideDown()
    $(".form").slideUp()
  }

  function limpiar () {
    $moneda.val("")
    $categoria.val("")
    $("#moneda_id").val("")
    $(".valid").removeClass("valid")
    $("label.active").removeClass("active")
    $(".guardar").attr("disabled", false)
      $('select').material_select("update");

  }

  function getData () {
    return {
      id:$("#moneda_id").val(),
      moneda:$moneda.val(),
      categoria:$categoria.val()
    }
  }

  // Validaciones
  function validarFormulario() {
    var flag = false

    if ($moneda.val() === "" || $moneda.val() === "0") {
      $moneda.focus()
      toast("Porfavor ingresar la moneda")

    } else if ($categoria.val() == null) {
      toast("Porfavor ingrese el categoria")

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
      $.ajax({
        type:"POST",
        url:"monedas/servicio/guardar.php",
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
  }

  function onNuevo () {
    $(".table").slideUp()
    $(".form").slideDown()
  }

  function reporteGeneral() {
    window.open (`./monedas/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $nuevo.on("click", onNuevo)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)
  $reporteGeneral.on("click", reporteGeneral)

})()
