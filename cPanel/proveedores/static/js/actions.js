;(function(){
  'use strict'

  var $eliminar = $(".eliminar")
  var $editar = $(".editar")
  var $alertaCancelar = $(".Alerta-cancelar")
  var $alertaEliminar = $(".Alerta-eliminar")
  var $reporte = $(".reporte-table")

  // Utilidades
  function render_form (data) {
    $("#proveedor_id").val(data.codigo_proveedor)
    $("#nombre").val(data.nombre_proveedor)
    $("#email").val(data.email_proveedor)
    $("#telefono").val(data.telefono_proveedor)
    $("#celular").val(data.celular_proveedor)
    $("#direccion").val(data.direccion_proveedor)

    $("#nombreContacto").val(data.nombre_contacto)
    $("#emailContacto").val(data.email_contacto)
    $("#telefonoContacto").val(data.telefono_contacto)
    $("#celularContacto").val(data.celular_contacto)

    $(".validate").addClass("valid")
    $(".field-label").addClass("active")
  }
  
  // Eventos
  function onEliminar (e) {
    var codigo = e.currentTarget.dataset.codigo
    $alertaEliminar.data('codigo', codigo)

    $(".Alerta").slideDown()
    $(".u-oculto").slideDown()
  }

  function onAlertaCancelar () {
    $(".Alerta").slideUp()
    $(".u-oculto").slideUp()
  }

  function onEditar (e) {
    var codigo = e.currentTarget.dataset.codigo
    $(".table").slideUp()
    $(".form").slideDown()
    $.ajax({
      type:"GET",
      data:{ codigo:codigo },
      dataType:"JSON",
      url:"proveedores/servicio/proveedor.php"
    })
    .done(function (data) {
      render_form(data)
    })
  }

  function onAlertaEliminar (e) {
    // var cedula = e.currentTarget.dataset.cedula
    var codigo = $alertaEliminar.data('codigo')
    $.ajax({
      type:"POST",
      url:"proveedores/servicio/eliminar.php",
      data:{ codigo:codigo }
    })
    .done(function (data) {
      console.log(data)
      if(data == 2) {
        toast("Se ha eliminado con exito")
        onAlertaCancelar()
        $(".table").load('proveedores/partials/table.php')
      }
    })
  }

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./proveedores/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }


  $eliminar.on("click", onEliminar)
  $editar.on("click", onEditar)
  $alertaCancelar.on("click", onAlertaCancelar)
  $alertaEliminar.on("click", onAlertaEliminar)
  $reporte.on("click", reporte)
})()