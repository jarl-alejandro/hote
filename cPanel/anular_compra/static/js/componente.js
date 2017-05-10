;(function() {
  'use strict'

  localStorage.clear()

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});

  $(".facturas-table").load('anular_compra/partials/table.php')

  var $cancelarFactura = $(".cancelar-factura")

  function cancelarFactura () {
    $(".facturas-table").slideDown()
    $(".form").slideUp()
    $("#facturat_tbody").empty()
    $(".total_factura").html("0.00")
    $(".facturas-table").load('anular_compra/partials/table.php')
    $("#habitacion").val("")
    $("#habitacion_codigo").val("")
    $("#detalle").val("")
    $(".disabled-active").removeClass("active")
    $("#detalle").removeClass("valid")
    $(".detail_label").removeClass("active")
    $(".aceptar-factura").attr("disabled", false)
    $(".show-clientes").attr("disabled", false)
    $(".productos").attr("disabled", false)
    $("#detalle").attr("disabled", false)
  }

  $cancelarFactura.on("click", cancelarFactura)

})()