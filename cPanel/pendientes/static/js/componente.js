;(function (){
	'use strict'

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('pendientes/partials/table.php')

  var $reporteGeneral = $("#reporteGeneral")
  var $porfecha = $("#porfecha")
  var $pendiente_cerrar = $(".pendiente_cerrar")
  var $pendiente_aceptar = $(".pendiente_aceptar")

  // Inputs
  var $hasta = $("#hasta")
  var $desde = $("#desde")

  function reporteGeneral() {
    window.open (`./pendientes/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function por_fecha () {
    $(".RotacionFecha").slideDown()
  }

  function pendiente_cerrar () {
    $(".RotacionFecha").slideUp()
  }

  function pendiente_aceptar () {

    if(validar()) {
      $(".table").slideUp()
      $(".table").load(`pendientes/partials/table-fecha.php?desde=${$desde.val()}&hasta=${$hasta.val()}`)

      setTimeout(function () {
        $(".table").slideDown()
        $(".RotacionFecha").slideUp()
      }, 200)      
    }

  }

  function validar () {
    var flag = false

    if ($hasta.val() == "") {
      toast("Porfavor ingrese la fecha")
    }
    else if($desde.val() == "") {
      toast("Porfavor ingrese la fecha")
    } else flag = true

    return flag
  }

  $reporteGeneral.on("click", reporteGeneral)
  $porfecha.on("click", por_fecha)
  $pendiente_cerrar.on("click", pendiente_cerrar)
  $pendiente_aceptar.on("click", pendiente_aceptar)

})()
