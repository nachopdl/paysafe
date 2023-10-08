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
                        if (res == 0) {
                            $('#mensaje').html('Usuario no existe');
                            $('#mail').val('');
                            $('#password').val('');
                            setTimeout(function() {
                                $('#mensaje').html('');
                            }, 5000);
                            $("#mail").focus();
                        } else {
                            window.location.href = "index.php";
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
        </div>

    </form>
</body>

</html>