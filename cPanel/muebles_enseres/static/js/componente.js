;(function (){
	'use strict'

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('muebles_enseres/partials/table.php')

  var $nuevo = $("#nuevo")
  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $reporteGeneral = $("#reporteGeneral")

  // Inputs
  var $precio = $("#precio")
  var $vida = $("#vida")
  var $desc = $("#desc")

  // Utilidades

  function u_formulario () {
    limpiar()
    $(".table").load('muebles_enseres/partials/table.php')
    $(".table").slideDown()
    $(".form").slideUp()
  }

  function limpiar () {
    $("#muebles_id").val("")
    $precio.val("")
    $vida.val("")
    $desc.val("")
    $(".valid").removeClass("valid")
    $("label.active").removeClass("active")
  }

  function getData () {
    return {
      id:$("#muebles_id").val(),
      vida:$vida.val(),
      precio:$precio.val(),
      desc:$desc.val()
    }
  }

  // Validaciones
  function validarFormulario() {
    var flag = false

    if ($desc.val() === "" || /^\s*$/.test($desc.val())) {
      $desc.focus()
      toast("Porfavor ingrese el mueble y enseres")

    } else if ($vida.val() === "" || $vida.val() === "0") {
      $vida.focus()
      toast("Porfavor ingrese los años de vida util")

    } else if ($precio.val() === "" || /^\s*$/.test($precio.val())) {
      $precio.focus()
      toast("Porfavor ingrese el precio")

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
        url:"muebles_enseres/servicio/guardar.php",
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
    window.open (`./muebles_enseres/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $nuevo.on("click", onNuevo)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)
  $reporteGeneral.on("click", reporteGeneral)

})()
