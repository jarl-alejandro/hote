;(function () {
    'use strict'

    $("#submit-email").on("click", function (e) {
        e.preventDefault()
        if(validarEmail()) {
            var data = { email:$("#email").val(), mensaje:$("#mensaje").val() }

            $.ajax({
                type:"POST",
                data,
                url:"servicios/enviar_email.php"
            })
            .done(function (response) {
                console.log(response)
                if(response == 2) 
                    toast("Se ha enviado su email com exito")
                else toast("Tuvimos problemas al enviar el email")
            })
        }
    })

    function validarEmail () {
        var flag = false

        if ($("#email").val() === "" || /^\s*$/.test($("#email").val())) {
            $("#email").focus()
            toast("Porfavor ingrese su email")
        } 
        else if ($("#mensaje").val() === "" || /^\s*$/.test($("#mensaje").val())) {
            $("#mensaje").focus()
            toast("Porfavor ingrese su mensaje")
        }
        else flag = true
        return flag
    }

})()