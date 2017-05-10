;(function (){
	'use strict'

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

	$(".table").load("pagos_mensuales/partials/table.php")
	$('input, textarea').characterCounter();
	$('.tooltipped').tooltip({delay: 50});


	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15, // Creates a dropdown of 15 years to control year
	});

	var $desde = $("#desde")
	var $hasta = $("#hasta")

	$("#reporteGeneral").on("click", function () {
		window.open (`./pagos_mensuales/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
	})

	$("#reportByDate").on("click", function () {
		$("#PagosByDate").slideDown()
	})

	$("#Cerrar").on("click", close)

	$("#Aceptar").on("click", function (e) {
		e.preventDefault()

		var type = e.currentTarget.dataset.type

		if(validarFechasByPagos()){
			if(type === "fecha") {
				window.open(`./pagos_mensuales/reporte/fecha.php?desde=${$desde.val()}&hasta=${$hasta.val()}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
				document.getElementById('Aceptar').dataset.type = ""
			}
			else {
				$(".table").load(`pagos_mensuales/partials/fecha.php?desde=${$desde.val()}&hasta=${$hasta.val()}`)
			}
			close()
		}
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
		if($hasta.val() === "") {
			toast("Porfavor ingrese la fecha de fin de pago")
			$hasta.addClass("valid")
			$(".hasta_label").addClass("active")
			return false
		}
		if($hasta.val() <= $desde.val()){
			toast("ingrese la fecha correcta")
			$hasta.addClass("valid")
			$(".hasta_label").addClass("active")
			return false
		}
		else return true
	}

	function close () {
		$("#PagosByDate").slideUp()
		$desde.val("")
		$hasta.val("")
		$desde.removeClass("valid")
		$(".desde_label").removeClass("active")
		$hasta.removeClass("valid")
		$(".hasta_label").removeClass("active")
	}

})()
