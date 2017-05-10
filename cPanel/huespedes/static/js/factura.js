;(function() {
  'use strict'

  ivaFactura()


  $("#desc-select").val($("#porcent-desc").html())

  $('select').material_select();

  var $cancelarFactura = $(".cancelar-factura")
  var $aceptarFactura = $(".aceptar-factura")
  var $seeVentas = $(".see-ventas")
  var $descuento = $("#desc-select")

  function ivaFactura(){
    var id = $("#id-factura").val()
    var porcent = parseFloat($("#iva-params").html())
    var subtotal = parseFloat($("#subtotal").html())
    var total = parseFloat($("#total-fact").html())
    
    var iva = porcent / 100
    var result = subtotal * iva
    var buy = result + total

    $("#iva-fact").html(result.toFixed(2))
    $("#total-fact").html(buy.toFixed(2))

    $.ajax({
      type: "POST",
      url: "huespedes/servicio/iva.php",
      data: { id, iva: result}
    })
    .done(function (snap){

    })
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
    }, 300)

  }

  function aceptarFactura (e) {
    var cedula = e.currentTarget.dataset.cedula
    var codigo = e.currentTarget.dataset.codigo
    var reservacion = e.currentTarget.dataset.reservacion
    var type = e.currentTarget.dataset.type

    $(".FormaDePago").slideDown()
    var pay = document.getElementById("pagar-btn")
    pay.dataset.cedula = cedula
    pay.dataset.codigo = codigo
    pay.dataset.reservacion = reservacion
    pay.dataset.type = type

    var cant = $(".total_factura").html()
    $(".cant-pay").html(cant)
  }

  function pagars (e) {
    var cedula = e.currentTarget.dataset.cedula
    var codigo = e.currentTarget.dataset.codigo
    var reservacion = e.currentTarget.dataset.reservacion

    $.ajax({
      type:"POST",
      url:"huespedes/servicio/dejar.php",
      data:{ cedula:cedula, codigo:codigo }
    })
    .done(function (data) {
      if(data == 2) {
        toast("Se ha realizado la operacion con exito.")
        cancelarFactura()
      } else if(data == 1) {
        toast("Tuvimos problemas")
        console.log(data)
      }
    })
  }

  function seeVentas (e) {
    var id = e.currentTarget.dataset.id
    $('.ventas').load(`huespedes/partials/ventas.php?venta=${id}`)
    setTimeout(function () {
      $(".u-oculto").slideDown()
      $('.ventas').slideDown()
    }, 200)
  }

  function handleChangeDesc (e) {
    e.preventDefault()
    var desc = parseInt($descuento.val()) / 100

    var subtotal = parseFloat($("#subtotal").html())
    var iva = parseFloat($("#iva-fact").html())
    var total = parseFloat($("#total-input").val())
    var abono = parseFloat( $('#abono_factura').val() ) || 0

    total = total + iva
    var id = $("#id-factura").val()

    var result = desc * subtotal
    result = parseFloat(result.toFixed(2))
    var price = total - result - abono

    $("#porcent-desc").html($descuento.val())
    $("#descuento-fact").html(result.toFixed(2))
    $("#total-fact").html(price.toFixed(2))

    $.ajax({
      type: "POST",
      url: "huespedes/servicio/descuento.php",
      data: { desc: result, id, tipo: $descuento.val() }
    })
    .done(function (snap) {
      console.log(snap)
    })
  }

  $(".reporte-fact").on("click", function (e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./huespedes/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  })

  $cancelarFactura.on("click", cancelarFactura)
  $seeVentas.on("click", seeVentas)
  $aceptarFactura.on("click", aceptarFactura)
  $descuento.on("change", handleChangeDesc)

})()
