;(function (){
	'use strict'

  var db_ventas = []

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});

  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $ventas = $("#ventas")

  // Inputs
  var $producto = $("#producto")

  function getData() {
    return {
      ventas:$ventas.val(),
      productos:db_ventas,
    }
  }

  function validar() {
    var flag = false

    if($ventas.val() == null) {
      toast("Porfavor ingrese el producto")

    } else if(db_ventas.length == 0) {
      toast("No puede hacer una devolucion si no hay productos")

    } else flag = true

    return flag
  }

  function limpiar () {
    $ventas.val("")
    $ventas.attr("disabled", false)
    $(".field-label").removeClass("active")    
    $('select').material_select("update")
    $("#table_producto").html("")
    db_ventas = []
    $("#total_productos").html("0.00")
    localStorage.clear()
    $(".Layout").load('devolucion_venta')
  }

  function cancelar (e) {
    e.preventDefault()
    limpiar()
  }

  function guardar (e) {
    e.preventDefault()

    if (validar()) {
      $.ajax({
        type:"POST",
        url:"devolucion_venta/servicio/guardar.php",
        data:getData()
      })
      .done(function(data) {
          console.log(data)

        if(data == 2) {
          toast("Se ha realizado la devolucion de venta con exito")
          limpiar()
        } else {
          console.log(data)
        }
      })
    }
  }

  function ventas (e) {
    $.ajax({
      type:"GET",
      url:"devolucion_venta/servicio/detalles.php",
      data:{ codigo:$ventas.val() },
      datatType:"html"
    })
    .done(function (data) {
      console.log(data)
      $ventas.attr("disabled", true)
      $('select').material_select("update")
      localStorage.clear()
      db_ventas = JSON.parse(data)
      localStorage.setItem("ventas", JSON.stringify(db_ventas))
      build_ventas()
    })
  }

  function build_ventas () {
    $("#table_producto").html("")
    var total = 0

    for (var i in db_ventas) {
      var venta = db_ventas[i]
      total += parseFloat(venta.precio)
      var template = $(`<tr class="row" style="display:none">
          <td>${ venta.producto }</td>
          <td>${ venta.nombre }</td>
          <td>${ venta.cant }</td>
          <td>${ venta.valor }</td>
          <td>${ venta.precio }</td>
        </tr>`)
      $("#table_producto").append(template)
      template.fadeIn()
    }
    // $(".eliminar_venta").on("click", eliminar_venta)
    $("#total_productos").html(total.toFixed(2))
  }

  function eliminar_venta (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id

    for(var i in db_ventas){
      var pedido = db_ventas[i]

      if(pedido.id == id){
        db_ventas.splice(i, 1)
        localStorage.setItem("ventas", JSON.stringify(db_ventas))
        build_ventas()
      }

    }
  }

  $cancelar.on("click", cancelar)
  $guardar.on("click", guardar)
  $ventas.on("change", ventas)

})()
