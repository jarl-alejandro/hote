;(function (){
	'use strict'

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('categorias/partials/table.php')

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  var $nuevo = $("#nuevo")
  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $reporteGeneral = $("#reporteGeneral")

  // Inputs
  var $categoria = $("#categoria")
  var $descripcion = $("#descripcion")
  var $cant = $("#cant")

  // Utilidades

  function u_formulario () {
    limpiar()
    $(".table").load('categorias/partials/table.php')
    $(".table").slideDown()
    $(".form").slideUp()
  }

  function limpiar () {
    $("#cedula_id").val("")
    $categoria.val("")
    $descripcion.val("")
    $cant.val("")
    $("#categoria_id").val("")
    $(".valid").removeClass("valid")
    $("label.active").removeClass("active")
  }

  function getData () {
    return {
      id:$("#categoria_id").val(),
      categoria:$categoria.val(),
      descripcion:$descripcion.val(),
      cant:$cant.val()
    }
  }

  // Validaciones
  function validarFormulario() {
    var flag = false

    if ($categoria.val() === "" || /^\s*$/.test($categoria.val())) {
      $categoria.focus()
      toast("Porfavor ingrese una categoria")

    } else if ($cant.val() === "" || $cant.val() === "0") {
      $cant.focus()
      toast("Porfavor ingrese la cantidad de habitaciones")

    } else if ($descripcion.val() === "" || /^\s*$/.test($descripcion.val())) {
      $descripcion.focus()
      toast("Porfavor ingrese una descripcion")

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
        url:"categorias/servicio/guardar.php",
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
    window.open (`./categorias/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $nuevo.on("click", onNuevo)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)
  $reporteGeneral.on("click", reporteGeneral)

})()
