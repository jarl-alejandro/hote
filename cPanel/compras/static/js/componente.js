;(function (){
	'use strict'

  var db_pedidos = []

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});

  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")

  // Inputs
  var $pedidos = $("#pedidos")
  var $factura = $("#factura")
  var $pedidos = $("#pedidos")

  function getData() {
    return {
      factura:$factura.val(),
      pedidos:$pedidos.val(),
      producto:db_pedidos,
    }
  }

  function validar() {
    var flag = false

    if($factura.val() == "" || /^\s*$/.test( $factura.val() ) ){
      toast("Porfavor ingrese el numero de factura")
      $factura.focus()

    }else if($pedidos.val() == null) {
      toast("Porfavor ingrese el pedidos")

    } else if(db_pedidos.length == 0) {
      toast("No puede realizar ningun ingreso si no hay producto que ingresar")

    } else flag = true

    return flag
  }

  function limpiar () {
    $pedidos.val("")
    $factura.val("")
    $pedidos.attr("disabled", false)
    $("#table_producto").html("")
    $("#total_productos").html("0.00")
    $(".field-label").removeClass("active")    
    $('select').material_select("update")
    db_pedidos = []
    localStorage.clear()
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
        url:"compras/servicio/guardar.php",
        data:getData(),
      })
      .done(function(data) {
        console.log(data)

        if(data == 2) {
          toast("Se ha realizado la compra con exito")
          limpiar()
          $(".Layout").load('compras')
        } else {
          console.log(data)
        }
      })
    }
  }

  function onPedidoChange () {
    $.ajax({
      type:"GET",
      url:"compras/servicio/detalles.php",
      data:{ codigo:$pedidos.val() },
      datatType:"JSON"
    })
    .done(function (data) {
      $pedidos.attr("disabled", true)
      $('select').material_select("update")
      localStorage.clear()
      db_pedidos = JSON.parse(data)
      localStorage.setItem("pedidos", JSON.stringify(db_pedidos))
      build_pedidos()
    })
  }

  function build_pedidos() {
    $("#table_producto").html("")
    var total = 0

    for (var i in db_pedidos) {
      var pedido = db_pedidos[i]
      total += parseFloat(pedido.precio)
      var template = $(`<tr class="row" style="display:none">
          <td>${ pedido.producto }</td>
          <td>${ pedido.nombre }</td>
          <td><input data-id="${ pedido.id }" value="${ pedido.cant }" onkeypress="ValidaSoloNumeros()" maxlength="5" class="validate cant-pedido" /></td>
          <td><input data-id="${ pedido.id }" value="${ pedido.valor }" onkeypress="ValidaSoloDecimal()" maxlength="5" class="validate valor-pedido" /></td>
          <td class="precio" data-id="${ pedido.id }">${ pedido.precio }</td>
          <td>
            <button data-id="${ pedido.id }" class="eliminar_pedido waves-effect waves-teal btn-flat">
              <i class="material-icons">clear</i>
            </button>
          </td>
        </tr>`)
      $("#table_producto").append(template)
      template.fadeIn()
    }
    $(".eliminar_pedido").on("click", eliminar_pedido)
    $(".cant-pedido").on("keyup", cant_pedido)
    $(".valor-pedido").on("keyup", valor_pedido)
    $("#total_productos").html(total.toFixed(2))
  }

  function build_totales () {
    var total = 0

    for (var i in db_pedidos) {
      var pedido = db_pedidos[i]
      total += parseFloat(pedido.precio)
    }
    $("#total_productos").html(total.toFixed(2))
  }

  function eliminar_pedido (e){
    e.preventDefault()
    var id = e.currentTarget.dataset.id

    for(var i in db_pedidos){
      var pedido = db_pedidos[i]

      if(pedido.id == id){
        db_pedidos.splice(i, 1)
        localStorage.setItem("pedidos", JSON.stringify(db_pedidos))
        build_pedidos()
      }

    }
  }

  function cant_pedido () {
    var el = $(this)
    var id = el.data("id")

    for (var i in db_pedidos ) {
      if (db_pedidos[i].id == id) {
        if(el.val() != "" && el.val() != 0){
          db_pedidos[i].cant = el.val()
          var precio = parseFloat(db_pedidos[i].valor) * parseInt(el.val())
          db_pedidos[i].precio = precio.toFixed(2)
          $(`.precio[data-id="${id}"]`).html(precio.toFixed(2))
          localStorage.setItem("pedidos", JSON.stringify(db_pedidos))
        }
        else{
          toast("No puedes ingresar cero")
          el.val(db_pedidos[i].cant)
        }
      } 
    }
    build_totales()
    // $(`.cant-pedido[data-id="${id}"]`).focus()
  }

  function valor_pedido () {
    var el = $(this)
    var id = el.data("id")

    for (var i in db_pedidos ) {
      if (db_pedidos[i].id == id) {
        if(el.val() != "" && parseFloat(el.val()) != 0){
          db_pedidos[i].valor = el.val()
          var precio = parseInt(db_pedidos[i].cant) * parseFloat(el.val())
          db_pedidos[i].precio = precio.toFixed(2)
          $(`.precio[data-id="${id}"]`).html(precio.toFixed(2))
          localStorage.setItem("pedidos", JSON.stringify(db_pedidos))
        }
        else{
          toast("No puedes ingresar cero")
          el.val(db_pedidos[i].valor)
        }       

      } 
    }
    build_totales()
  }

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $cancelar.on("click", cancelar)
  $guardar.on("click", guardar)
  $pedidos.on("change", onPedidoChange)

})()
