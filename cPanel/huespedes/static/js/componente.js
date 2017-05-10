;(function (){
	'use strict'
	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table-huesped").load('huespedes/partials/table.php')
  $('select').material_select();

  var $reporteGeneral = $("#reporteGeneral")
  var $numeroDeposito = $("#num_deposito")

  $("#cerrar-btn").on("click", function (e) {
    e.preventDefault()
    $(".FormaDePago").slideUp()
    var pay = document.getElementById("pagar-btn")
    pay.dataset.cedula = ""
    pay.dataset.codigo = ""
    $("#num_deposito").val("")
    document.getElementById("efectivo").checked = false
    document.getElementById("deposito").checked = false
    $(".deposito-container").slideUp()
  })

  function reporteGeneral() {
    window.open (`./huespedes/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }


  function FormaDePagoInput (e) {
    var type = e.currentTarget.dataset.type

    if(type === "deposito") $(".deposito-container").slideDown()
    else if(type !== "deposito") $(".deposito-container").slideUp()
  }

  function Pagar (e) {
    e.preventDefault()
    if(validarPago()) {
      var cedula = e.currentTarget.dataset.cedula
      var codigo = e.currentTarget.dataset.codigo
			var reservacion = e.currentTarget.dataset.reservacion
      var type = e.currentTarget.dataset.type

			var total = parseFloat($(".total_factura").html())

      $.ajax({
        type:"POST",
        url:`huespedes/servicio/${type}.php`,
        data:{ cedula:cedula, codigo:codigo, reservacion,
					 		deposito:$numeroDeposito.val(), total }
      })
      .done(function (data) {
        console.log(data)
        if(data == 2) {
          toast("Se ha realizado la operacion con exito.")
          cancelarFactura()
          $("#num_deposito").val("")
          document.getElementById("efectivo").checked = false
          document.getElementById("deposito").checked = false
          $(".deposito-container").slideUp()
          window.open(`./huespedes/reporte/individual.php?codigo=${reservacion}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
        } else if(data == 1) {
          toast("Tuvimos problemas")
          console.log(data)
        }
      })
    }
  }

  function cancelarFactura () {
    $(".table-huesped").load('huespedes/partials/table.php')

    setTimeout(function() {
      $(".table-huesped").slideDown()
      $(".form").slideUp()
      $("#facturat_tbody").empty()
      $("#cedula").val("")
      $("#fecha").val("")
      $("#detalle").val("")
      $(".FormaDePago").slideUp()
      var pay = document.getElementById("pagar-btn")
      pay.dataset.cedula = ""
      pay.dataset.codigo = ""
    }, 300)

  }

  function validarPago () {
    var flag = false
    var forma = Array.prototype.slice.call(document.querySelectorAll(".input-dinner"))
    var items_pagos = []

    for (var i in forma) {
      var item = forma[i]

      if (item.checked == true) {
        var type = item.dataset.type
        if(type === "deposito") {
          if($numeroDeposito.val() === "" || /^\s*$/.test( $numeroDeposito.val() )) {
            $numeroDeposito.focus()
            toast("Porfavor ingrese el numero del deposito.")
            return false
          }
        }
        return true
      }
      else items_pagos.push(item)
    }

    if(items_pagos.length === forma.length) {
      toast("Porfavor selecione la forma de pago")
    }

    return flag
  }

  function modalSalir () {
    $("#ModalSalir").slideUp()
    $("#messageDesalojo").val("")
  }

  function AceptarSalir (e){
    var alquiler = e.currentTarget.dataset.id
    var message = $("#messageDesalojo")

    if(message.val() === "" || /^\s*$/.test( message.val() )) {
      message.focus()
      toast("Porfavor ingrese el informe de salida")
      return false
    }

    $.ajax({
      type: "POST",
      url: "huespedes/servicio/desalogo.php",
      data: { message:message.val(), alquiler },
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap)
      if(snap.status == 201) {
        modalSalir()
        $(".table-huesped").load('huespedes/partials/table.php')
        window.open(`./huespedes/reporte/desalojo.php?id=${snap.codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
      }
    })

  }

  $reporteGeneral.on("click", reporteGeneral)
  $(".input-dinner").on("change", FormaDePagoInput)
  $("#pagar-btn").on("click", Pagar)
  $("#cerrarSalir").on("click", modalSalir)
  $("#aceptarSalir").on("click", AceptarSalir)


})()
