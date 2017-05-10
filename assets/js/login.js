;(function(){
  'use strict'

  // $("form").trigger('reset')
  // document.forms[0].reset()
  $('input, textarea').characterCounter()
  // Materialize.updateTextFields();

	
	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}


  var $login = $(".login")
  var $user = $("#user")
  var $pass = $("#password")

  function login (e) {
    e.preventDefault()
    if(validar()){
      $.ajax({
        type:"POST",
        url:"servicios/login.php",
        data: { user:$user.val(), pass:$pass.val() }
      })
      .done(function (data) {
        console.log(data)
        if(data == 1) toast("Usuario no existe.")
        else if(data == 2){
          toast("Bienvenido, ha iniciado session.")
          location.reload()
        }
        else if(data == 3) {
          toast("Este usuario esta bloqueado por hoy")
        }
      })
    }
  }

  function validar () {
    var flag = false

    if ($user.val() === "") {
      $user.focus()
      toast("Porfavor ingrese su numero de cedula")

    } else if ($pass.val() === "" || /^\s*$/.test($pass.val())) {
      $pass.focus()
      toast("Porfavor ingrese su contraseña")
    } else flag = true

    return flag
  }

  $login.on("click", login)

})()
