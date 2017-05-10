;(function (){
	'use strict'

  var monedas_db = []

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('cierre_caja/partials/table.php')
  $('select').material_select();

  var $cuadreCaja = $(".cuadre-caja")
  var $showMonedas = $(".show-monedas")
  var $aceptarMoneda = $(".aceptar-moneda")
  var $cierreParcial = $(".cierre-parcial")
  var $aceptarCierre = $(".aceptar-cierre")

  // Inputs
  var $monedas = $("#monedas")
  var $cant = $("#cant")

  function cuadreCaja (e) {
    e.preventDefault()
    $(".CuadreCaja").slideDown()
  }

  function showMonedas () {
    $(".monedas-cuadre").slideDown()
  }

  function aceptarMoneda () {
    if (validarMonedas()) {
      var item = document.querySelectorAll(".moneda-item")

      item.forEach(function (e) {
       if (e.value == $monedas.val()) {
        var desc = e.dataset.desc
        var cat = e.dataset.cat
        var total = parseInt($cant.val()) * parseFloat(desc)
        var ctx = { codigo:$monedas.val(), cant:$cant.val(), total:total, desc:desc, cat:cat }
        monedas_db.push(ctx)
        builder(ctx)
        builder_total()
        cerrar_moneda()
       }
      })

    }
  }

  function cerrar_moneda () {
    $(".monedas-cuadre").slideUp()
    $monedas.val("")
    $cant.val("")
    $cant.removeClass("valid")
    $("label.active").removeClass("active")
    $('select').material_select("update")
  }

  function builder_total () {
    var total = 0
    for (var i in monedas_db)
      total += parseFloat(monedas_db[i].total)
    $(".total_cuadre").html(total.toFixed(2))
  }

  function builder(ctx){
    var template = ` <tr>
        <td>${ ctx.cant }</td>
        <td>${ ctx.desc } ${ ctx.cat }</td>
        <td>${ ctx.total.toFixed(2) }</td>
      </tr>`
    $("#arqueo_caja").append(template)
  }

  function validarMonedas () {
    var flag = false

    if($monedas.val() == null) {
      toast("Ingrese una moneda")
    }
    else if ($cant.val() === "" || $cant.val() === "0") {
      $cant.focus()
      toast("Porfavor ingrese la cantidad")
    } else flag = true

    return flag
  }

  function cierreParcial () {
    window.open (`./cierre_caja/reporte/cierre_parcial.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }
  function aceptarCierre () {
    if (validar_cuadre()) {
      $.ajax({
        type:"POST",
        url:"cierre_caja/servicio/guardar.php",
        data:{monedas:monedas_db}
      })
      .done(function (data) {
        var parse = JSON.parse(data)
        if(parse.status == 2) {
          var path_actual = location.pathname
          toast("Se ha realizado su operacion con exito.")
          cierreParcial()
          window.open (`./cierre_caja/reporte/monedas.php?id=${parse.codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
          location.pathname = `${path_actual}/../../servicios/salir.php`
        }
        else console.log(data)
      })
    }
  }

  function validar_cuadre() {
    var cuadre = parseFloat($(".total_cuadre").html())
    var cierre = parseFloat($("#cierre_caja_total").html())
    var flag = false

    if(cuadre === cierre) {
      flag = true
    } else {
      toast("No cuadran las cuentas")
    }

    return flag
  }

	$(".cerrar-moneda").on("click", cerrar_moneda)
	$(".hide-monedas").on("click", function () {
		$(".CuadreCaja").slideUp()
	})

  $cuadreCaja.on("click", cuadreCaja)
  $showMonedas.on("click", showMonedas)
  $aceptarMoneda.on("click", aceptarMoneda)
  $cierreParcial.on("click", cierreParcial)
  $aceptarCierre.on("click", aceptarCierre)

})()
