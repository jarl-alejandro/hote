;(function(){
  'use strict'

  var $facturaSee = $(".factura-see")
  var $anular = $(".anular")

  function render (data) {
    var venta = data[0];

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

  function facturaSee(e) {
    var codigo = e.currentTarget.dataset.codigo
    $.ajax({
      type:"POST",
      url:"anular_venta/servicio/venta.php",
      data: { codigo:codigo },
      dataType:"JSON"
    })
    .done(function (data) {
      render(data)
    })
  }


  function anular (e) {
    var codigo = e.currentTarget.dataset.codigo
    document.getElementById("Alerta-anular").dataset.codigo = codigo
    $(".Alerta").slideDown()
  }

  function anularVenta (e) {
    var codigo = e.currentTarget.dataset.codigo
    $.ajax({
      type:"POST",
      url:"anular_venta/servicio/anular.php",
      dataType:"JSON",
      data: { codigo }
    })
    .done(function (response) {
      console.log(response)
      if (response[0].status === 200) {
        $(".Alerta").slideUp()
        $(".facturas-table").load('anular_venta/partials/table.php')
      }
    })
  }

  $anular.on("click", anular)
  $facturaSee.on("click", facturaSee)
  $("#Alerta-anular").on("click", anularVenta)

  $(".Alerta-cancelar").on("click", function () {
    $(".Alerta").slideUp()
  })
})()