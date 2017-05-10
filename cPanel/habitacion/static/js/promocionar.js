;(function(){
  'use strict'

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});

  var $promocionar = $(".promocionar")
  var $promocionCancelar = $(".promocion-cancelar")
  var $promocionSend = $(".promocion-btn")

  // Inputs
  var $descriptionPromo = $("#description-promo")
  var $descuentoPromo = $("#descuento-promo")

  // Validaciones
  function validarPromocion () {
    var flag = false

    if (/^\s*$/.test($descriptionPromo.val())) {
      toast("Porfavor ingrese una descripcion")
      $descriptionPromo.focus()
    }
    else if (/^\s*$/.test($descuentoPromo.val()) || $descuentoPromo.val() === "0") {
      toast("Porfavor ingrese el descuento")
      $descuentoPromo.focus()      

    } else flag = true

    return flag
  }

  // Eventos

  function OnPromocionCancelar () {
    
    $(".Promocion").slideUp()
    var valor = document.querySelector(".promocion-btn")
    valor.dataset.codigo = ""
    valor.dataset.valor = ""

    $descriptionPromo.val("")
    $descuentoPromo.val("")
    $("label.active").removeClass("active")
    $("input.valid").removeClass("valid")
    $(".table").load('habitacion/partials/table.php')

  }

  function OnPromocionar (e) {
    var id = e.currentTarget.dataset.codigo
    var valor = e.currentTarget.dataset.valor
    $(".Promocion").slideDown()
    var valorBoton = document.querySelector(".promocion-btn")
    valorBoton.dataset.codigo = id
    valorBoton.dataset.valor = valor
  }

  function OnPromocionSend (e) {
    var id = e.currentTarget.dataset.codigo
    var valor = e.currentTarget.dataset.valor

    if(validarPromocion()) {
      $.ajax({
        type:"POST",
        url:"habitacion/servicio/promocionar.php",
        data: { codigo:id, valor:valor, det:$descriptionPromo.val(), desc:$descuentoPromo.val() }
      })
      .done(function (data) {
        if(data == 2) {
          OnPromocionCancelar()
          toast("Se ha realizado su operacion con exito")
        } 
        else console.log(data)

      })
    }

  }

  function handleEliminarPromocion (e) {
    var id = e.currentTarget.dataset.codigo
    var valor = e.currentTarget.dataset.valor
    $.ajax({
      type: 'POST',
      url: 'habitacion/servicio/promocionarEliminar.php',
      data: { id, valor }
    })
    .done(function (snap) {
      console.log(snap)
      if (snap == 2) {
        toast("Se ha realizado su operacion con exito")
        $(".table").load('habitacion/partials/table.php')        
      }
    })
  } 

  $promocionCancelar.on("click", OnPromocionCancelar)
  $promocionar.on("click", OnPromocionar)
  $promocionSend.on("click", OnPromocionSend)

  $(".promocionarEliminar").on('click', handleEliminarPromocion)

})()