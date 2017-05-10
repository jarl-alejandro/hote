;(function () {
  'use strict'

  var $mensaje = $("#mensaje")

  $("#modalBtn").on("click", modalClient)
  $("#close").on("click", closeModal)
  $("#enviar").on("click", enviarEmail)

  function modalClient () {
    $("#modalClient").slideDown()
  }

  function closeModal () {
    $("#modalClient").slideUp()
    $mensaje.val("")
  }

  function enviarEmail () {
    if (validEmail()) {
      $.ajax({
        type: "POST",
        data: { mensaje:$mensaje.val() },
        url: "mejores_clientes/email.php"
      })
      .done(function (snap) {
        console.log(snap)
        if (snap == 2) {
          toast("Se ha enviado con exito el e-mail a los mejores clientes")
          closeModal()
        }
        else {
          toast("No se ha podido enviar el e-mail a los mejores clientes")
        }
      })
    }
  }

  function validEmail () {
    if($mensaje.val() === "" || /^\s*$/.test( $mensaje.val() )){
      toast("Porfavor ingrese el email que va a enviar")
      mensaje.focus()
      return false
    }
    else return true
  }

})()