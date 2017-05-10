;(function () {
  'use strict'
  // $("form")[0].reset()

  function toast(msg){
    Materialize.toast(msg, 3000)
  }

  $(".login-cliente").on("click", function (e) {
    e.preventDefault()
    $(".modal-material").slideDown()
  })

  $(".create-cliente").on("click", function (e) {
    e.preventDefault()
    $(".modal-cliente").slideDown()
  })

  $("#cerrar").on("click", function (e) {
    e.preventDefault()
    $(".modal-material").slideUp()
    $("#user").val("")
    $("#password").val("")
    $("input.valid").removeClass("valid")
    $("label.active").removeClass("active")
  })

  $(".login").on("click", function (e) {
    e.preventDefault()

    if (validar()) {
      $.ajax({
        type:"POST",
        url:"servicios/login-cliente.php",
        data: { user:$("#user").val(), password:$("#password").val() }
      })
      .done(function (data) {
        console.log(data)
        if(data === "1") {
          toast("Usuario no existe.")
        }
        else {
          toast("Bienvenido, ha iniciado sesión con exito.")
          location.reload()
        }
      })
    }

  })


  function validar () {
    var flag = false

    if($("#user").val() == "") {
      toast("Porfavor ingrese su numero de cedula")
      $("#user").focus()
    }
    else if($("#password").val() == "") {
      toast("Porfavor ingrese su contraseña")
      $("#password").focus()
    }
    else flag = true

    return flag
  }

})()
