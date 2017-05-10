;(function (){
	'use strict'
	
	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('productos/partials/table.php')

  var $nuevo = $("#nuevo")
  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $reporteGeneral = $("#reporteGeneral")
  var $maximo = $("#maximo")
  var $minimo = $("#minimo")

  // Inputs
  var $nombre = $("#nombre")
  var $valor = $("#valor")
  var $cantidad = $("#cantidad")
  var $tipo = $("#tipo")

  // Utilidades
  function u_formulario () {
    limpiar()
    $(".table").load('productos/partials/table.php')
    $(".table").slideDown()
    $(".form").slideUp()
  }

  function limpiar () {
    $("#producto_id").val("")
    $nombre.val("")
    $valor.val("")
    $cantidad.val("")
    $tipo.val("")
    $('select').material_select("update");
    $(".valid").removeClass("valid")
    $("label.active").removeClass("active")
    $maximo.attr("disabled", false)
    $minimo.attr("disabled", false)
    $maximo.val("")
    $minimo.val("")
  }

  function getData () {
    return {
      id : $("#producto_id").val(),
      nombre : $nombre.val(),
      valor : $valor.val(),
      cantidad : $cantidad.val(),
      tipo : $tipo.val(),
      maximo : $maximo.val(),
      minimo : $minimo.val(),
    }
  }

  // Validaciones

  function validarFormulario() {
    var flag = false

    if ($tipo.val() === null) {
      $tipo.focus()
      toast("Porfavor ingrese el tipo del producto/servicio")

    } else if ($nombre.val() === "" || /^\s*$/.test($nombre.val())) {
      $nombre.focus()
      toast("Porfavor ingrese un nombre")

    }else if($valor.val() === "") {
      $valor.focus()
      toast("Porfavor ingrese el valor del producto/servicio")

    } else if($cantidad.val() ===  ""){
      $cantidad.focus()
      toast("Porfavor ingrese la cantidad del producto/servicio")

    } else if($tipo.val() === "producto") {

      if($maximo.val() === "" || $maximo.val() == "0") {
        $maximo.focus()
        toast("Porfavor ingrese el maximo de producto")

      } else if($minimo.val() === "" || $minimo.val() == "0") {
        $minimo.focus()
        toast("Porfavor ingrese el minimo de producto")

      } else if(parseInt($maximo.val()) <= parseInt($cantidad.val())) {
        $cantidad.focus()
        toast("Porfavor la cantidad que ingreso no puede ser mayor que la cantidad maximo")

      }else if(parseInt($minimo.val()) >= parseInt($cantidad.val())) {
        $minimo.focus()
        toast("Porfavor ingreso el minimo no debe ser mayor que la cantidad que ingrese")
      } else flag = true

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
        url:"productos/servicio/guardar.php",
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
    window.open (`./productos/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function onChange () {
    if ($tipo.val() === "producto") {
      $maximo.attr("disabled", false)
      $minimo.attr("disabled", false)      
    } else {
      $maximo.attr("disabled", true)
      $minimo.attr("disabled", true)
    }
  }

  $nuevo.on("click", onNuevo)
  $tipo.on("change", onChange)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)
  $reporteGeneral.on("click", reporteGeneral)

})()
