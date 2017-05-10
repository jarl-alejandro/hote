;(function(){
  'use strict'

  var $facturaSee = $(".factura-see")
  var $reporte = $(".reporte-table")

  function render (data) {
    var venta = data[0];
    console.log(venta)

    $("#cliente").val(`${venta.venta.cedula}`)
    $("#detalle").val(`${venta.venta.detalle}`)
    $("#fecha").val(venta.venta.fecha)
    $(".total_factura").html(venta.venta.total)
    $(".disabled-active").addClass("active")
    $("#detalle").addClass("valid")
    $(".detail_label").addClass("active")
    $("#cliente").attr("disabled", true)
    $(".aceptar-factura").attr("disabled", true)
    $(".show-clientes").attr("disabled", true)
    $(".productos").attr("disabled", true)
    $("#detalle").attr("disabled", true)

    $("#nombre").val(`${venta.venta.cliente}`)    
    $("#direccion").val(`${venta.venta.direccion}`)    

    $("#subTotal_factura").html(`${venta.venta.subtotal}`)    
    $("#iva-factura").html(`${venta.venta.iva}`)    
    $("#desc-factura").html(`${venta.venta.desc}`)    
    $("#porcent-desc").html(`${venta.venta.porcent}`)

    $("#desc-select").val(venta.venta.porcent) 
    $('select').material_select("update");

    for(var i in venta.detalle) {
      var detalle = venta.detalle[i]

      var tr = `<tr>
        <td>${ detalle.cant }</td>
        <td>${ detalle.producto }</td>
        <td>${ detalle.unit }</td>
        <td>${ detalle.total }</td>
      </tr>`

      $("#facturat_tbody").append(tr)
    }

    $(".facturas-table").slideUp()
    $(".form").slideDown()
  }

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./restaurante/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function facturaSee(e) {
    var codigo = e.currentTarget.dataset.codigo
    $.ajax({
      type:"POST",
      url:"restaurante/servicio/venta.php",
      data: { codigo:codigo },
      dataType:"JSON"
    })
    .done(function (data) {
      render(data)
    })
  }

  $reporte.on("click", reporte)
  $facturaSee.on("click", facturaSee)
})()