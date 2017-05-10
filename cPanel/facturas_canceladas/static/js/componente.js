;(function (){
	'use strict'

	$(".table").load("facturas_canceladas/partials/table.php")
	$('input, textarea').characterCounter();
	$('.tooltipped').tooltip({delay: 50});

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}


	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15,
		max: $("#fecha_actual").val()
	});

	var $desde = $("#desde")
	var $hasta = $("#hasta")

	$("#reporteGeneral").on("click", function () {
		window.open (`./facturas_canceladas/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
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
				window.open(`./facturas_canceladas/reporte/fecha.php?desde=${$desde.val()}&hasta=${$hasta.val()}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
				document.getElementById('Aceptar').dataset.type = ""
			}
			else {
				$(".table").load(`facturas_canceladas/partials/fecha.php?desde=${$desde.val()}&hasta=${$hasta.val()}`)
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
			toast("Ingrese la fecha correcta")
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
