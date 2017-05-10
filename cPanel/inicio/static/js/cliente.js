;(function (){
	'use strict'

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});

  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")

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
		$('#newClient').closeModal();
    $("#clientes-select").load("inicio/partials/clientes.php", function () {
    $('select').material_select()

    setTimeout(function () {

      $("#cliente").val(getData().cedula)
      $('select').material_select("update")
      $("#cliente").val()
      limpiar()

      $("label#fecha_active").addClass("active")
    }, 2000)

    })
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

function validarFormulario() {
  var flag = false

  if ($cedula.val() === "") {
    $cedula.focus()
    toast("Porfavor ingrese el numero de cedula.")

  } else if (!valida_ce($cedula.val())) {
    $cedula.focus()

  } else if ($nombre.val() === "" || /^\s*$/.test($nombre.val())) {
    $nombre.focus()
    toast("Porfavor ingrese un nombre")

  } else if ($apellido.val() === "" || /^\s*$/.test($nombre.val())) {
    $apellido.focus()
    toast("Porfavor ingrese un apellido")

  } else if($email.val() === "") {
    $email.focus()
    toast("Porfavor ingrese un e-mail")

  } else if(emailValid($email.val()) === false){
    $email.focus()
    toast("Porfavor ingrese un e-mail valido")

  } else if($telefono.val() ===  ""){
    $telefono.focus()
    toast("Porfavor ingrese un numero de telefono")

  } else if ($telefono.val().length < 9) {
    $telefono.focus()
    toast("Porfavor ingrese un numero de telefono correcto")

  }else if($celular.val() === ""){
    $celular.focus()
    toast("Porfavor ingrese un numero de celular")

  } else if ($celular.val().length < 10) {
    $celular.focus()
    toast("Porfavor ingrese un numero de celular correcto")

  } else if($direccion.val() === "" || /^\s*$/.test($direccion.val())){
    $direccion.focus()
    toast("Porfavor ingrese una direccion")

  } else flag = true
  return flag
}

  // Eventos

  function onCancelar (e) {
    e.preventDefault()
    limpiar()
		$('#newClient').closeModal();
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
          u_formulario()
          toast("Se ha registrado con exito.")
          $('#newClient').closeModal();

        } else if (data == 20) {
          toast("Se ha actualizado con exito.")
          $('#newClient').closeModal();
          u_formulario()
        } else if(data == 1) {
          toast("Ya existe usuario con numero de cedula registrado")
          $cedula.focus()
        }

      })
    }
  }


  $email.on("change", validar_email)
  $cedula.on("change", validar_cedula)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)

})()
