;(function() {
  'use strict'

  localStorage.clear()

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});

  $(".facturas-table").load('anular_venta/partials/table.php')

  var $cancelarFactura = $(".cancelar-factura")

  function cancelarFactura () {
    $(".facturas-table").slideDown()
    $(".form").slideUp()
    $("#facturat_tbody").empty()
    $(".total_factura").html("0.00")
    $(".facturas-table").load('anular_venta/partials/table.php')
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