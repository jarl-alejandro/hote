;(function () {
  'use strict'
  $('select').material_select()
  $('.materialboxed').materialbox()

  var $habitacion = $("#habitacion")
  var $trasladar = $("#trasladar")
  var $habitacionNew = $("#habitacion_new")

  function habitacion () {
    $.ajax({
      type:"GET",
      url:"traslado/service/habitaciones.php",
      data:{ codigo:$habitacion.val() },
      dataType:"JSON"
    })
    .done(function (data){
      console.log(data)
      builder_detalle(data)
    })
  }

  function builder_detalle (detalle) {
    $("#habitaciones").html("")

    var template = `<tr>
      <td style="padding: 0 !important;">${ detalle.cedula }</td>
      <td style="padding: 0 !important;">${ detalle.cliente }</td>
      <td style="padding: 0 !important;">${ detalle.valor }</td>
    </tr>`
    $("#habitaciones").append(template)
  }

  function onTraslado (){
    $(".habitacionesContainer").slideDown()
  }

  function trasladar () {
    if(validarTraslado()) {
      $.ajax({
        type:"POST",
        url:"traslado/service/trasladar.php",
        data:getData()
      })
      .done(function (res) {
        console.log(res)
        if(res == 2) {
          $(".Layout").load('inicio')
          $(".title-layout").html("Alquiler de habitaciones")
        }
      })
    }
  }

  function getData() {
    var check = document.getElementById('mismoValor');
    return {
      habitacion: $habitacion.val(),
      nuevaHabitacion: $habitacionNew.val(),
      valor:check.checked
    }
  }

  function validarTraslado () {
    var flag = false

    if($habitacion.val() == null){
      toast("Porfavor ingrese la habitacion a trasladar")
    }
    else if($habitacionNew.val() == null) {
      toast("Porfavor ingrese la habitacionen la que se va trasladar")
    }
    else flag = true

    return flag
  }

  $habitacion.on("change", habitacion)
  $trasladar.on("click", trasladar)

})()
