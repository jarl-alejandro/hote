;(function (){
	'use strict'

	$(".table").load("cierra-parcial-fecha/partials/table.php")
	$('input, textarea').characterCounter();
	$('.tooltipped').tooltip({delay: 50});


	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15, // Creates a dropdown of 15 years to control year
		max: $("#fecha_actual").val()
	});

	var $desde = $("#desde")

	$("#reporteGeneral").on("click", function () {
		window.open (`./cierra-parcial-fecha/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
	})

	$("#reportByDate").on("click", function () {
		$("#PagosByDate").slideDown()
	})

	$("#Cerrar").on("click", close)

	$("#Aceptar").on("click", function (e) {
		e.preventDefault()

		var type = e.currentTarget.dataset.type

		if(validarFechasByPagos()){
			$(".table").load(`cierra-parcial-fecha/partials/fecha.php?desde=${$desde.val()}`)
      $('#fecha_desde').val($desde.val())
			close()
		}
	})

  $('.cierre-parcial').on('click', function () {
      var fecha = $('#fecha_desde').val()
      window.open(`./cierra-parcial-fecha/reporte/fecha.php?desde=${fecha}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  })

	$("#byReport").on("click", function () {
		$("#PagosByDate").slideDown()
		document.getElementById('Aceptar').dataset.type = "fecha"
	})

	function validarFechasByPagos () {
		if ($desde.val() === "") {
			toast("Porfavor ingrese la fecha de inicio de pago")
			$desde.addClass("valid")
			$(".desde_label").addClass("active")
			return false
		}
		else return true
	}

	function close () {
		$("#PagosByDate").slideUp()
		$desde.val("")
		$desde.removeClass("valid")
		$(".desde_label").removeClass("active")
	}

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

})()
