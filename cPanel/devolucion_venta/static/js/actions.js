;(function(){
  'use strict'

  var array_productos = []
  var arary_devueltos = []

  var $facturaSee = $(".factura-see")
  var $reporte = $(".reporte-table")

  function render (data) {
    var venta = data[0];

    $("#codigo_venta").val(venta.venta.codigo)
    $("#habitacion").val(`Nº ${venta.venta.habitacion}`)
    $("#detalle").val(`${venta.venta.detalle}`)
    $("#fecha").val(venta.venta.fecha)
    $(".total_factura").html(venta.venta.total)
    $(".disabled-active").addClass("active")
    $("#detalle").addClass("valid")
    $(".detail_label").addClass("active")
    $(".show-clientes").attr("disabled", true)
    $(".aceptar-factura").attr("disabled", true)
    $(".productos").attr("disabled", true)
    $("#detalle").attr("disabled", true)

    for(var i in venta.detalle) {
      var detalle = venta.detalle[i]
      var ctx = { 'codigo':detalle.codigo, 'cant':detalle.cant, 'valor':detalle.unit, 'total':detalle.total,
        'nombre':detalle.producto }

      array_productos.push(ctx)

      var tr = `<tr>
        <td>${ detalle.cant }</td>
        <td>${ detalle.producto }
          <button class="btn-flat waves-effect waves-light eliminar"
            data-id="${ detalle.id }" data-i="${ i }">
            <i class="material-icons">clear</i>
          </button>
        </td>
        <td>${ detalle.unit }</td>
        <td>${ detalle.total }</td>
      </tr>`

      $("#facturat_tbody").append(tr)
    }
    $(".eliminar").on("click", eliminar)

    localStorage.setItem("ventas", JSON.stringify(array_productos))

    $(".facturas-table").slideUp()
    $(".form").slideDown()
  }

  function eliminar (e) {
    if(array_productos.length > 1){
      var codigo = e.currentTarget.dataset.id
      var i = e.currentTarget.dataset.i

      arary_devueltos.push({ codigo })
      array_productos.splice(i, 1)
      localStorage.setItem("ventas", JSON.stringify(array_productos))
      localStorage.setItem("devueltos", JSON.stringify(arary_devueltos))
      construir()
      $(".aceptar-factura").attr("disabled", false)

    }
    else {
      toast("No puede eliminar todas para eso usted debe anular la factura")
    }

  }

  function construir () {
    var parse = JSON.parse(localStorage.getItem("ventas"))
    $("#facturat_tbody").html("")
    var total = 0

    for (var i in parse) {
      var detalle = parse[i]
      total += parseFloat(detalle.total)
      var tr = `<tr>
        <td>${ detalle.cant }</td>
        <td>${ detalle.nombre }
          <button class="btn-flat waves-effect waves-light eliminar"
            data-id="${ detalle.codigo }" data-i="${ i }">
            <i class="material-icons">clear</i>
          </button>
        </td>
        <td>${ detalle.valor }</td>
        <td>${ detalle.total }</td>
      </tr>`

      $("#facturat_tbody").append(tr)
    }
    $(".total_factura").html(total.toFixed(2))
    $(".eliminar").on("click", eliminar)

  }

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./facturas/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function facturaSee(e) {
    var codigo = e.currentTarget.dataset.codigo
    $.ajax({
      type:"POST",
      url:"devolucion_venta/servicio/venta.php",
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
