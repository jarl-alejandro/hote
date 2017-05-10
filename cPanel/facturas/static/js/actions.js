;(function(){
  'use strict'

  var $facturaSee = $(".factura-see")
  var $reporte = $(".reporte-table")

  function render (data) {
    var venta = data[0];
    console.log(venta);

    $("#cliente").val(venta.venta.cliente)
    $(".labelcli").addClass("active")

    $("#habitacion").val(`Nº ${venta.venta.habitacion}`)
    $("#detalle").val(`${venta.venta.detalle}`)
    $("#fecha").val(venta.venta.fecha)
    $(".total_factura").html(venta.venta.total)
    $(".disabled-active").addClass("active")
    $("#detalle").addClass("valid")
    $(".detail_label").addClass("active")
    $(".aceptar-factura").attr("disabled", true)
    $(".show-clientes").attr("disabled", true)
    $(".productos").attr("disabled", true)
    $("#detalle").attr("disabled", true)

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
    window.open (`./facturas/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function facturaSee(e) {
    var codigo = e.currentTarget.dataset.codigo
    $.ajax({
      type:"POST",
      url:"facturas/servicio/venta.php",
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
