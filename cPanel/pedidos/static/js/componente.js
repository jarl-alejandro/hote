;(function (){
	'use strict'

  var DB = []
  localStorage.clear()

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table_bajo").load('pedidos/partials/table.php')

  var $reporteGeneral = $("#reporteGeneral")
  var $nuevo = $("#nuevo")
  var $guardar = $(".guardar")
  var $producto = $(".producto")
  var $cerrarProductos = $(".cerrar-Productos")
  var $btnProducto = $(".btn-producto")
  var $cancelar = $(".cancelar")

  var $detalle = $("#descripcion")

  function validar_pedido () {
    var flag = false

    if(/^\s*$/.test($detalle.val())) {
      toast("Porfavor ingrese un detalle del pedido que va a realizar.")
      $detalle.focus()

    } else if(DB.length === 0) {
      toast("Porfavor ingrese los productos que va a pedir")
    } else flag = true

    return flag
  }

  function onNuevo () {
    $(".table_bajo").slideUp()
    $(".form").slideDown()
  }

  function reporteGeneral() {
    window.open (`./pedidos/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function onProducto () {
    $(".productos-list").slideDown()
  }

  function onGuardar (e) {
    e.preventDefault()
    if (validar_pedido()) {
      $.ajax({
        type:"POST",
        url:"pedidos/servicio/guardar.php",
        data:{ detalle:$detalle.val(), productos:DB },
        dataType:"JSON"
      })
      .done(function(data) {
        if(data.status == 203) {

          if(data.productos_pendientes[0] != undefined) {
            data.productos_pendientes.map(function (el) {
              toast(`El producto ${ el.nombre } con codigo ${ el.codigo } esta pendiente.`)
              toast("Porfavor elimine este producto para que pueda hacer el pedido.")
              sacarProducto(el)
            })

          }
        }
        else if(data.status == 2){
          toast("Se ha realizado su pedido con exito.")
          window.open (`./pedidos/reporte/pedido.php?codigo=${ data.codigo }`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
          limpiar()            
        }
      })

    }
  }

  function sacarProducto (object) {
    var parse = JSON.parse(localStorage.getItem("productos"))

    for (var i in parse) {
      var producto = parse[i]
      if (producto.codigo === object.codigo) {
        DB[i].ocupado = true
        localStorage.setItem("productos", JSON.stringify(DB))
        construir()
      }
    }
  }

  function limpiar () {
    $detalle.val("")
    $(".field-label").removeClass("active")
    $detalle.removeClass("valid")
    $("#table_producto").html("")
    $("#total_productos").html("0.00")
    DB = []
    localStorage.clear()
  }

  function cerrarProductos (e) {
    e.preventDefault()
    limpiar_productos()
  }

  function limpiar_productos() {
    $(".productos-list").slideUp()
    $(".cant_producto").removeClass("active")
    $(".input-producto").removeClass("valid")
    $(".input-producto").val("")
  }

  function btnProducto (e) {
    var codigo = e.currentTarget.dataset.codigo
    var nombre = e.currentTarget.dataset.nombre
    var valor = e.currentTarget.dataset.valor
    var max = e.currentTarget.dataset.max
    var cant = $(`#cant_${ codigo }`)

    if(cant.val() === "" || cant.val() == 0) {
      toast("Porfavor ingrese cantidad de productos")
      cant.focus()
    }
    else if(parseInt(cant.val()) >= parseInt(max)) {
      toast(`No puede pedir mas de ${ max }`)
      cant.focus()
    }
    else {
      var precio = parseInt(cant.val()) *  parseFloat(valor)
      var ctx = { codigo:codigo, nombre:nombre, valor:valor, 
        cant:cant.val(), precio:parseFloat(precio), ocupado:false
      }
      DB.push(ctx)
      localStorage.setItem("productos", JSON.stringify(DB))
      construir()
      limpiar_productos()
    }

  }

  function construir () {
    var productos = JSON.parse(localStorage.getItem("productos"))
    $("#table_producto").html("")
    var total = 0

    for(var i in productos) {
      var producto = productos[i]
      total += producto.precio
      var template = $(`<tr>
        <td>${ producto.codigo }</td>
        <td>${ producto.nombre }</td>
        <td>${ producto.cant }</td>
        <td>${ producto.valor }</td>
        <td>${ producto.precio.toFixed(2) }</td>
        <td>
          <button class="btn waves-effect waves-light blue text-red eliminar" data-i=${i}>Eliminar</button>
        </td>
      </tr>`)
      $("#table_producto").append(template)

      if(producto.ocupado === true){
        template.addClass("red white-text")
      }
    }
    $("#total_productos").html(total.toFixed(2))

    $(".eliminar").on("click", eliminar)
  }

  function eliminar (e) {
    e.preventDefault()
    var index = e.currentTarget.dataset.i
    DB.splice(index, 1)
    localStorage.setItem("productos", JSON.stringify(DB))
    
    construir()
  }

  function onCancelar (e) {
    e.preventDefault()
    $(".table_bajo").slideDown()
    $(".form").slideUp()
    limpiar()
  }

  $reporteGeneral.on("click", reporteGeneral)
  $nuevo.on("click", onNuevo)
  $producto.on("click", onProducto)
  $guardar.on("click", onGuardar)
  $cerrarProductos.on("click", cerrarProductos)
  $btnProducto.on("click", btnProducto)
  $cancelar.on("click", onCancelar)

})()
