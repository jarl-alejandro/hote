;(function(){
  'use strict'

  var $eliminar = $(".eliminar")
  var $editar = $(".editar")
  var $alertaCancelar = $(".Alerta-cancelar")
  var $alertaEliminar = $(".Alerta-eliminar")
  var $reporte = $(".reporte-table")
  var $ingresar = $(".ingresar")
  var $AlertaIngresar = $(".Alerta-ingresar")
  var $desbloquear = $(".desbloquear")
  var $AlertaDesbloquear = $(".Alerta-desbloquear")

  // Utilidades
  function render_form (data) {
    $("#cedula_id").val(data.cedula_cliente)
    $("#cedula").val(data.cedula_cliente)
    $("#nombre").val(data.nombre_cliente)
    $("#apellido").val(data.apellido_cliente)
    $("#email").val(data.email_cliente)
    $("#telefono").val(data.telefono_cliente)
    $("#celular").val(data.celular_cliente)
    $("#direccion").val(data.direccion_cliente)
    $(".validate").addClass("valid")
    $(".field-label").addClass("active")
  }

  // Eventos
  function onEliminar (e) {
    var cedula = e.currentTarget.dataset.cedula
    $alertaEliminar.data('cedula', cedula)

    $(".Alerta").slideDown()
    $(".u-oculto").slideDown()
  }

  function onAlertaCancelar () {
    $(".Alerta").slideUp()
    $(".Alerta-ingreso").slideUp()
    $(".Alerta-bloquear").slideUp()
    $(".u-oculto").slideUp()
  }

  function onEditar (e) {
    var cedula = e.currentTarget.dataset.cedula
    $(".table").slideUp()
    $(".form").slideDown()
    $.ajax({
      type:"GET",
      data:{ cedula:cedula },
      dataType:"JSON",
      url:"clientes/servicio/cliente.php"
    })
    .done(function (data) {
      render_form(data)
    })
  }

  function onAlertaEliminar (e) {
    // var cedula = e.currentTarget.dataset.cedula
    var cedula = $alertaEliminar.data('cedula')
    $.ajax({
      type:"POST",
      url:"clientes/servicio/eliminar.php",
      data:{ cedula:cedula }
    })
    .done(function (data) {
      console.log(data)
      if(data == 2) {
        toast("Se ha eliminado con exito")
        onAlertaCancelar()
        $(".table").load('clientes/partials/table.php')
      }
    })
  }

  function reporte(e) {
    var cedula = e.currentTarget.dataset.cedula
    window.open (`./clientes/reporte/individual.php?cedula=${cedula}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function ingresar (e) {
    var cedula = e.currentTarget.dataset.cedula
    $AlertaIngresar.data('cedula', cedula)
    $(".Alerta-ingreso").slideDown()
    $(".u-oculto").slideDown()
  }

  function AlertaIngresar (e) {
    var cedula = $AlertaIngresar.data('cedula')

    $.ajax({
      type:"POST",
      url:"clientes/servicio/ingresar.php",
      data:{ cedula:cedula }
    })
    .done(function (data) {
      if(data == 2) {
        toast("El cliente ha ingresado.")
        $(".table").load('clientes/partials/table.php')
        onAlertaCancelar()
      } else if(data == 1) {
        console.log(data)
      }
    })
  }

  function desbloquear (e) {
    var cedula = e.currentTarget.dataset.cedula
    $AlertaIngresar.data('cedula', cedula)
    $(".Alerta-bloquear").slideDown()
    $(".u-oculto").slideDown()
  }

  function AlertaDesbloquear () {
    var cedula = $AlertaIngresar.data('cedula')
    $.ajax({
      type:"POST",
      url:"clientes/servicio/desbloquear.php",
      data:{ cedula:cedula }
    })
    .done(function (data) {
        console.log(data)
      if(data == 2) {
        $(".table").load('clientes/partials/table.php')
        toast("El cliente ha sido desbloqueado.")
        onAlertaCancelar()        
      } else {
        console.log(data)
      }
    })
  }

  $eliminar.on("click", onEliminar)
  $editar.on("click", onEditar)
  $alertaCancelar.on("click", onAlertaCancelar)
  $alertaEliminar.on("click", onAlertaEliminar)
  $reporte.on("click", reporte)
  $ingresar.on("click", ingresar)
  $AlertaIngresar.on("click", AlertaIngresar)
  $desbloquear.on("click", desbloquear)
  $AlertaDesbloquear.on("click", AlertaDesbloquear)

})()