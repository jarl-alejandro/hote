;(function (){
	'use strict'

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('clientes/partials/table.php')

  var $nuevo = $("#nuevo")
  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $reporteGeneral = $("#reporteGeneral")

  // Inputs
  var $cedula = $("#cedula")
  var $nombre = $("#nombre")
  var $apellido = $("#apellido")
  var $email = $("#email")
  var $telefono = $("#telefono")
  var $celular = $("#celular")
  var $direccion = $("#direccion")

  // Utilidades

  function u_formulario () {
    limpiar()
    $(".table").load('clientes/partials/table.php')
    $(".table").slideDown()
    $(".form").slideUp()
  }

  function limpiar () {
    $("#cedula_id").val("")
    $cedula.val("")
    $nombre.val("")
    $apellido.val("")
    $email.val("")
    $telefono.val("")
    $celular.val("")
    $direccion.val("")
    $(".valid").removeClass("valid")
    $("label.active").removeClass("active")
  }

  function getData () {
    return {
      id:$("#cedula_id").val(),
      cedula:$cedula.val(),
      nombre:$nombre.val(),
      apellido:$apellido.val(),
      email:$email.val(),
      telefono:$telefono.val(),
      celular:$celular.val(),
      direccion:$direccion.val(),
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
	
	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

function validarFormulario() {
  var flag = false

  if ($cedula.val() === "") {
    $cedula.focus()
    toast("Porfavor ingrese el numero de cedula.")
    return false
  }
  if (!valida_ce($cedula.val())) {
    $cedula.focus()
    return false
  } 
  if ($nombre.val() === "" || /^\s*$/.test($nombre.val())) {
    $nombre.focus()
    toast("Porfavor ingrese un nombre")
    return false
  }
  if ($apellido.val() === "" || /^\s*$/.test($nombre.val())) {
    $apellido.focus()
    toast("Porfavor ingrese un apellido")
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
  if($telefono.val() != "") {
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
        url:"clientes/servicio/guardar.php",
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
          toast("Ya existe usuario con numero de cedula registrado")
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
    window.open (`./clientes/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $nuevo.on("click", onNuevo)
  $email.on("change", validar_email)
  $cedula.on("change", validar_cedula)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)
  $reporteGeneral.on("click", reporteGeneral)

})()
