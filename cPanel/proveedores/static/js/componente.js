;(function (){
	'use strict'

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('proveedores/partials/table.php')

  var $nuevo = $("#nuevo")
  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $reporteGeneral = $("#reporteGeneral")

  // Inputs
  var $nombre = $("#nombre")
  var $email = $("#email")
  var $telefono = $("#telefono")
  var $celular = $("#celular")
  var $direccion = $("#direccion")

  var $nombreContacto = $("#nombreContacto")
  var $emailContacto = $("#emailContacto")
  var $telefonoContacto = $("#telefonoContacto")
  var $celularContacto = $("#celularContacto")

  // Utilidades

  function u_formulario () {
    limpiar()
    $(".table").load('proveedores/partials/table.php')
    $(".table").slideDown()
    $(".form").slideUp()
  }

  function limpiar () {
    $("#proveedor_id").val("")
    $nombre.val("")
    $email.val("")
    $telefono.val("")
    $celular.val("")
    $direccion.val("")

    $nombreContacto.val("")
    $emailContacto.val("")
    $telefonoContacto.val("")
    $celularContacto.val("")
    $(".valid").removeClass("valid")
    $("label.active").removeClass("active")
  }

  function getData () {
    return {
      id : $("#proveedor_id").val(),
      nombre : $nombre.val(),
      email : $email.val(),
      telefono : $telefono.val(),
      celular : $celular.val(),
      direccion : $direccion.val(),
      nombreContacto : $nombreContacto.val(),
      emailContacto : $emailContacto.val(),
      telefonoContacto : $telefonoContacto.val(),
      celularContacto : $celularContacto.val(),
    }
  }

  // Validaciones
  function emailValid(input){
    var exp =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(input);
    return exp
  }

  function validar_email() {
    var $el = $(this)
    if(emailValid($el.val()) == false) {
      $el.addClass("invalid")
      toast("Porfavor ingrese un e-mail valido")
    }
  }

  function validar_cedula() {
    var $el = $(this)
    if(!valida_ce($el.val())) $cedula.focus()
  }

  function validarFormulario() {
    var flag = false

    if ($nombre.val() === "" || /^\s*$/.test($nombre.val())) {
      $nombre.focus()
      toast("Porfavor ingrese un nombre")
      return false
    }
    if($email.val() === "") {
      $email.focus()
      toast("Porfavor ingrese un e-mail")
      return false
    }
    if(emailValid($email.val()) === false){
      $email.focus()
      toast("Porfavor ingrese un e-mail valido")
      return false
    }
    if($telefono.val() != ""){
      if($telefono.val().length < 9){
        $telefono.focus()
        toast("Porfavor ingrese un numero de telefono correcto")
        return false
      }
    }
    if($celular.val() === ""){
      $celular.focus()
      toast("Porfavor ingrese un numero de celular")
      return false
    }
    if ($celular.val().length < 10) {
      $celular.focus()
      toast("Porfavor ingrese un numero de celular correcto")
      return false
    }
    if($direccion.val() === "" || /^\s*$/.test($direccion.val())){
      $direccion.focus()
      toast("Porfavor ingrese una direccion")
      return false
    }
    if ($nombreContacto.val() === "" || /^\s*$/.test($nombreContacto.val())) {
      $nombreContacto.focus()
      toast("Porfavor ingrese un nombre del Contacto")
      return false
    }
    if($emailContacto.val() === "") {
      $emailContacto.focus()
      toast("Porfavor ingrese un e-mail del Contacto")
      return false
    }
    if(emailValid($emailContacto.val()) === false){
      $emailContacto.focus()
      toast("Porfavor ingrese un e-mail valido")
      return false
    }
    if($telefonoContacto.val() != ""){
      if($telefonoContacto.val().length < 9){
        $telefonoContacto.focus()
        toast("Porfavor ingrese un numero de telefono de contacto correcto")
        return false
      }
    }
    if($celularContacto.val() === ""){
      $celularContacto.focus()
      toast("Porfavor ingrese un numero de celular del Contacto")
      return false
    }
    if ($celularContacto.val().length < 10) {
      $celularContacto.focus()
      toast("Porfavor ingrese un numero de celular del Contacto correcto")
      return false
    } 
    else flag = true
    return flag
  }

  // Eventos

  function onCancelar (e) {
    e.preventDefault()
    limpiar()
    $(".table").slideDown()
    $(".form").slideUp()
  }
  function onGuardar (e) {
    e.preventDefault()

    if (validarFormulario()) {
      $.ajax({
        type:"POST",
        url:"proveedores/servicio/guardar.php",
        data: getData()
      })
      .done(function (data) {
        console.log(data)
        if(data == 2) {
          toast("Se ha registrado con exito.")
          u_formulario()
        } else if (data == 20) {
          toast("Se ha actualizado con exito.")
          u_formulario()
        } else if(data == 1) {
          toast("Porfavor actualizado los parametros")
          $cedula.focus()
        } 

      })
    }
  }

  function onNuevo () {
    $(".table").slideUp()
    $(".form").slideDown()
  }

  function reporteGeneral() {
    window.open (`./proveedores/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $nuevo.on("click", onNuevo)
  $email.on("change", validar_email)
  $emailContacto.on("change", validar_email)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)
  $reporteGeneral.on("click", reporteGeneral)

})()
