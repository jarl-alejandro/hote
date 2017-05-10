;(function() {
  'use strict'

  var array_detalle = []
  localStorage.clear()

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".facturas-table").load('facturas/partials/table.php')

  var $nuevo = $("#nuevo")
  var $reporteGeneral = $("#reporteGeneral")
  var $cerrarHabitacion = $(".cerrar-habitacion")
  var $showClientes = $(".show-clientes")
  var $btnHabitacion = $(".btn-habitacion")
  var $productos = $(".productos")
  var $cerrarProductos = $(".cerrar-Productos")
  var $btnProducto = $(".btn-producto")
  var $cancelarFactura = $(".cancelar-factura")
  var $aceptarFactura = $(".aceptar-factura")

  // Inputs
  var $habitacion_codigo = $("#habitacion_codigo")
  var $habitacion = $("#habitacion")
  var $detalle = $("#detalle")

  function construir_factura () {
    $("#facturat_tbody").empty()
    var total = 0

    array_detalle.map(function (e) {
      total += e.total
      var tr = `<tr>
      <td>${ e.cant }</td>
      <td>${ e.nombre }</td>
      <td>${ e.valor }</td>
      <td>${ e.total }</td>
      </tr>`

      $("#facturat_tbody").append(tr)
    })

    $(".total_factura").html(total.toFixed(2))

  }

  function save_detalles (ctx) {
    if (array_detalle.length == 0) {
      array_detalle.push(ctx)
      construir_factura()
      return false
    }

    if (validProductos(ctx)) {
      array_detalle.push(ctx)
      construir_factura()
    }
  }

  function validProductos (ctx) {
    var flag = false

    for(var i in array_detalle) {
      var producto = array_detalle[i]

      if(producto.codigo === ctx.codigo) {

        producto.cant = parseInt(producto.cant) + parseInt(ctx.cant)
        producto.total = parseInt(producto.cant) * parseFloat(producto.valor)
        construir_factura()
        return false
      }
      else {
        flag = true
      }
    }
    return flag
  }

  function validar_factura () {
    var flag = false

    if($habitacion.val() == "") {
      toast("Porfavor ingrese la habitacion")

    } else if ($detalle.val() == "" || /^\s*$/.test($detalle.val())) {
      toast("Porfavor ingrese el detalle.")
      detalle.focus()

    } else if (array_detalle.length === 0) {
      toast("Porfavor ingrese un producto o servicio que desea adquierir")

    } else flag = true

    return flag
  }

  function onNuevo () {
    $(".facturas-table").slideUp()
    $(".form").slideDown()
    $(".productos").attr("disabled", true)
  }

  function reporteGeneral() {
    window.open (`./facturas/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function cerrarHabitacion () {
    $(".Habitaciones").slideUp()
    $(".u-oculto").slideUp()
  }

  function showClientes () {
    $(".Habitaciones").slideDown()
    $(".u-oculto").slideDown()
  }

  function btnHabitacion (e) {
    var nombre = e.currentTarget.dataset.nombre
    var cliente = e.currentTarget.dataset.cliente
    var codigo = e.currentTarget.dataset.codigo
    var cant = e.currentTarget.dataset.cant

    $("#habitacion").val(`Nº ${nombre}`)
    $("#habitacion_cant").val(cant)
    $(".disabled-active").addClass("active")
    $("#habitacion_codigo").val(codigo)
    $(".productos").attr("disabled", false)
    $(".show-clientes").attr("disabled", true)
    $("#cliente").val(cliente)
    $(".labelcli").addClass("active")
    cerrarHabitacion()
  }

  function productos () {
    $(".Productos").slideDown()
    $(".u-oculto").slideDown()
  }

  function cerrarProductos () {
    $(".input-producto").removeClass("valid")
    $(".input-producto").val("")
    $(".cant_producto").removeClass("active")
    $(".Productos").slideUp()
    $(".u-oculto").slideUp()
  }

  function btnProducto (e) {
    var nombre = e.currentTarget.dataset.nombre
    var codigo = e.currentTarget.dataset.codigo
    var valor = e.currentTarget.dataset.valor
    var max = e.currentTarget.dataset.max
    var tipo = e.currentTarget.dataset.tipo

    var cant = $(`#cant_${codigo}`)
    var valor_pagar = $("#habitacion_cant").val()
    var total = parseFloat(valor) * parseInt(cant.val())
    // total = total.toFixed(2)
    var ctx = { 'codigo':codigo, 'cant':cant.val(), 'valor':valor,
                  'total':total, 'nombre':nombre }

    if (cant.val() === "" || cant.val() === 0) {
      cant.focus()
      toast("Porfavor ingrese la cantidad que desea.")

    }
    else if(tipo === "producto") {
      if(parseInt(cant.val()) >= parseInt(max)) {
        toast(`No puede pedir mas de ${ max }`)
        cant.focus()
      }
    }
    if(valor_pagar != "indefinido") {
      // toast("Vmoass")
      if(total > parseFloat(valor_pagar)) {
        toast("Ha excedido lo que debe consumir")
      } else {
        var mequeda = valor_pagar - total
        $("#habitacion_cant").val(mequeda)
        llenar_productos(ctx, cant, codigo)
      }

    }
    else {
      llenar_productos(ctx, cant, codigo)
    }
  }

  function llenar_productos(ctx, cant, codigo) {
   save_detalles(ctx)
   $(`#label_${codigo}`).removeClass("active")
   cant.val("")
   cant.removeClass("valid")
   cerrarProductos()
 }

 function cancelarFactura () {
  $(".facturas-table").slideDown()
  $(".form").slideUp()
  $("#facturat_tbody").empty()
  $(".total_factura").html("0.00")
  $("#cliente").val("")
  $(".labelcli").removeClass("active")

  $(".facturas-table").load('facturas/partials/table.php')
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
  array_detalle = []
}

function getData () {
  return {
    habitacion_codigo:$habitacion_codigo.val(),
    detalle:$detalle.val(),
    total:$(".total_factura").html(),
    productos:array_detalle
  }
}

function aceptarFactura() {
  if(validar_factura()) {

    $.ajax({
      type:"POST",
      url:"facturas/servicio/guardar.php",
      data:getData(),
      dataType:"JSON"
    })
    .done(function (data) {
      console.log(data)
      if(data.status == 1) {
        toast("Porfavor actualize los parametros")
      }
      else if(data.status == 2) {
        var codigo = data.codigo
        toast("Se ha realizado con exito")
        window.open (`./facturas/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
        cancelarFactura()
      }
      else {
        console.log(data)
      }
    })

  }
}

$nuevo.on("click", onNuevo)
$reporteGeneral.on("click", reporteGeneral)
$cerrarHabitacion.on("click", cerrarHabitacion)
$showClientes.on("click", showClientes)
$btnHabitacion.on("click", btnHabitacion)
$productos.on("click", productos)
$cerrarProductos.on("click", cerrarProductos)
$btnProducto.on("click", btnProducto)
$cancelarFactura.on("click", cancelarFactura)
$aceptarFactura.on("click", aceptarFactura)

})()
