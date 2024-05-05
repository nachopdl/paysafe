<html>
    <head>
        <title>Login PaySafe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
        <link rel="stylesheet" href="css/login_style.css">
        <script src="jquery-3.3.1.min.js"></script>
        <script>
            function checkLogin(){
                var mail = $('#mail').val();
                var pass = $('#password').val();
    
                if (mail === '' || pass === '') {
                    $('#mensaje').html('Faltan campos por llenar...');
                    setTimeout(function() {
                        $('#mensaje').html('');
                    }, 5000);
                    return;
                }
                
                $.ajax({
                    url: "funciones/valida_login.php",
                    type: 'POST',
                    data: {
                        mail: mail,
                        pass: pass
                    },
                    dataType: 'text',
                    success: function(res) {
                        console.log("el valor de res es:"+res)
                        if (res == 1) {
                            window.location.href = "dashboard.php";
                            
                        } else {
                            $('#mensaje').html('Usuario no existe/Datos incorrectos.');
                            $('#mail').val('');
                            $('#password').val('');
                            setTimeout(function() {
                                $('#mensaje').html('');
                            }, 5000);
                            $("#mail").focus();
                        }
                    },
                    error: function() {
                        alert("Error al conectar al servidor...");
                    }
                });
            }
        </script>
    </head>
    <body>
    <form action="" name="login" method="post">
        <img src="images/logo.webp" class="img-responsive">
        <h1>Inicio de sesión</h1>
        <label>
            <input type="text" placeholder="Correo Electrónico" id="mail">
        </label>
        <label>
            <input type="password" id="password" placeholder="Contraseña">
        </label>
        <div id="mensaje">
        </div>
        <div class="boton">
            <input type="button" class="btn" onclick="checkLogin();" value="Login">
            <input type="button" class="btn" value="Volver" onclick="location.href='https://andromedapay.000webhostapp.com/index.php'">

        </div>

    </form>
</body>

</html>