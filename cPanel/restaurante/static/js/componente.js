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
  $(".facturas-table").load('restaurante/partials/table.php')

  var $nuevo = $("#nuevo")
  var $reporteGeneral = $("#reporteGeneral")
  var $cerrarHabitacion = $(".cerrar-habitacion")
  var $showClientes = $(".show-clientes")
  var $btnCliente = $(".btn-habitacion")
  var $productos = $(".productos")
  var $cerrarProductos = $(".cerrar-Productos")
  var $btnProducto = $(".btn-producto")
  var $cancelarFactura = $(".cancelar-factura")
  var $aceptarFactura = $(".aceptar-factura")
  var $numeroDeposito = $("#num_deposito")
  var $descuento = $("#desc-select")

  // Inputs
  var $habitacion_codigo = $("#habitacion_codigo")
  var $habitacion = $("#habitacion")

  function construir_factura () {
    $("#facturat_tbody").empty()
    var total = 0

    array_detalle.map(function (e) {
      total += e.total 
      var tr = `<tr>
      <td>${ e.cant }</td>
      <td>${ e.nombre }</td>
      <td>${ e.valor }</td>
      <td>${ e.total.toFixed(2) }</td>
      </tr>`

      $("#facturat_tbody").append(tr)
    })
    calcTotales(total)
  }

  function calcTotales(subtotal){
    $("#subTotal_factura").html(subtotal.toFixed(2))
    var ivaPorcent = parseInt($("#iva-params").html()) / 100
    var descPorcent = parseInt($descuento.val()) / 100
    var iva = subtotal * ivaPorcent
    var desc = subtotal * descPorcent
    var total= subtotal + iva - desc

    $("#iva-factura").html(iva.toFixed(2))
    $("#desc-factura").html(desc.toFixed(2))
    $("#porcent-desc").html($descuento.val())
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

    if($("cliente").val() == "") {
      toast("Porfavor ingrese el cliente")

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
    window.open (`./restaurante/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function cerrarHabitacion () {
    $(".Habitaciones").slideUp()
    $(".u-oculto").slideUp()
  }

  function showClientes () {
    $(".Habitaciones").slideDown()
    $(".u-oculto").slideDown()
  }

  function btnCliente (e) {
    var codigo = e.currentTarget.dataset.codigo
    var nombre = e.currentTarget.dataset.nombre
    var direccion = e.currentTarget.dataset.direccion

    $("#nombre").val(`${nombre}`)
    $("#cliente").val(`${codigo}`)
    $("#direccion").val(direccion)
    $(".disabled-active").addClass("active")
    $(".productos").attr("disabled", false)
    $("#cliente").attr("disabled", true)
    $(".show-clientes").attr("disabled", true)
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

    var cant = $(`#cant_${codigo}`)
    var total = parseFloat(valor) * parseInt(cant.val())
    var ctx = { 'codigo':codigo, 'cant':cant.val(), 'valor':valor, 'total':total, 'nombre':nombre }

    if (cant.val() === "" || cant.val() === 0) {
      cant.focus()
      toast("Porfavor ingrese la cantidad que desea.")
      
    } 
    else if(parseInt(cant.val()) >= parseInt(max)) {
      toast(`No puede pedir mas de ${ max }`)
      cant.focus()
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

  $("#nombre").val("")
  $("#cliente").val("")
  $("#cliente").attr("disabled", false)
  $("#cliente").removeClass("invalid")
  
  $(".show-clientes").attr("disabled", false)
  $(".productos").attr("disabled", true)
  $(".aceptar-factura").attr("disabled", false)

  $(".FormaDePago").slideUp()
  var pay = document.getElementById("pagar-btn")
  pay.dataset.cedula = ""
  pay.dataset.codigo = ""

  array_detalle = []

  $(".facturas-table").load('restaurante/partials/table.php')

  $("#iva-factura").html("0.00")
  $("#desc-factura").html("0.00")
  $("#porcent-desc").html("0")
  $(".total_factura").html("0.00")
  $("#subTotal_factura").html("0.00")  
  $("#direccion").val("")
  $descuento.val("")
  $('select').material_select("update");
}

function getData () {
  return {
    cliente: $("#cliente").val(),
    deposito: $("#num_deposito").val(),
    subtotal: $("#subTotal_factura").html(),
    iva: $("#iva-factura").html(),
    desc: $("#desc-factura").html(),
    porcent: $("#porcent-desc").html(),
    total: $(".total_factura").html(),
    productos: array_detalle
  }  
}

function aceptarFactura () {
  if(validar_factura()) {
    $(".FormaDePago").slideDown()
    var total = $(".total_factura").html()
    $(".cant-pay").html(total)
  }  
}

function PagarRestaurante(e) {
  e.preventDefault()
  
  if(validarPago()) {
    $(".aceptar-factura").attr("disabled", true)

    $.ajax({
      type:"POST",
      url:"restaurante/servicio/guardar.php",
      data:getData(),
      dataType:"JSON"
    })
    .done(function (data) {
      $(".aceptar-factura").attr("disabled", false)      
      if(data.status == 1) {
        toast("Porfavor actualize los parametros")
      } 
      else if(data.status == 2) {
        var codigo = data.codigo
        toast("Se ha realizado con exito")
        window.open (`./restaurante/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
        cancelarFactura()
      }
      else {
        console.log(data)
      }
    })

  }
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

function FormaDePagoInput (e) {
  var type = e.currentTarget.dataset.type
    
  if(type === "deposito") $(".deposito-container").slideDown()
  else if(type !== "deposito") $(".deposito-container").slideUp()
}

function clienteConsumidor() {
  var el = $(this)
  if(el.val() === ".") {
    el.val("xxxxxxxxxx")
    $(".show-clientes").attr("disabled", true)
    el.attr("disabled", true)
    el.removeClass("invalid")
    $(".productos").attr("disabled", false)
  }
}

function handleChangeDescuento (e){
  e.preventDefault()
  var subtotal = parseFloat($("#subTotal_factura").html())
  calcTotales(subtotal)
}

$nuevo.on("click", onNuevo)
$reporteGeneral.on("click", reporteGeneral)
$cerrarHabitacion.on("click", cerrarHabitacion)
$showClientes.on("click", showClientes)
$btnCliente.on("click", btnCliente)
$productos.on("click", productos)
$cerrarProductos.on("click", cerrarProductos)
$btnProducto.on("click", btnProducto)
$cancelarFactura.on("click", cancelarFactura)
$aceptarFactura.on("click", aceptarFactura)
$("#pagar-btn").on("click", PagarRestaurante)
$descuento.on("change", handleChangeDescuento)


$(".input-dinner").on("change", FormaDePagoInput)
$("#cliente").on("keyup", clienteConsumidor)

$("#cerrar-btn").on("click", function (e) {
  e.preventDefault()
  $(".FormaDePago").slideUp()
  var pay = document.getElementById("pagar-btn")
  pay.dataset.cedula = ""
  pay.dataset.codigo = ""
})

})()