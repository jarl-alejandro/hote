;(function() {
  'use strict'

  var array_detalle = []
  localStorage.clear()

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".facturas-table").load('devolucion_venta/partials/table.php')

  var $reporteGeneral = $("#reporteGeneral")
  var $cerrarHabitacion = $(".cerrar-habitacion")
  var $cancelarFactura = $(".cancelar-factura")
  var $aceptarFactura = $(".aceptar-factura")

  // Inputs
  var $habitacion_codigo = $("#habitacion_codigo")
  var $habitacion = $("#habitacion")
  var $detalle = $("#detalle")

  
  
  function reporteGeneral() {
    window.open (`./devolucion_venta/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

 function cancelarFactura () {
    localStorage.clear()
    $("#facturat_tbody").html("")
    $(".facturas-table").slideDown()
    $(".form").slideUp()
    $("#facturat_tbody").empty()
    $(".total_factura").html("0.00")
    $(".facturas-table").load('devolucion_venta/partials/table.php')
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

function getData () {
  var codigo = $("#codigo_venta").val()
  var devueltos = JSON.parse(localStorage.getItem("devueltos"))          

  return {
    total:$(".total_factura").html(),
    devueltos,
    codigo
  }
}
    // dataType:"JSON"

function aceptarFactura() {
  toast("Espere un momento....")
  $(".aceptar-factura").attr("disabled", true)
  $.ajax({
    type:"POST",
    url:"devolucion_venta/servicio/devolucion.php",
    data:getData(),
  })
  .done(function (data) {
    console.log(data)
    if(data == 1) {
      toast("Porfavor actualize los parametros")
    } 
    else if(data == 2) {
      toast("Se ha realizado con exito")
      // window.open (`./devolucion_venta/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
      cancelarFactura()
    } 
    else {
      console.log(data)
    }
  })

}

$reporteGeneral.on("click", reporteGeneral)
$cancelarFactura.on("click", cancelarFactura)
$aceptarFactura.on("click", aceptarFactura)

})()