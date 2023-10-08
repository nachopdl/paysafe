<html>
    <head>
        <title>Registro de usuario</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/registro_style.css">
        <script src="jquery-3.3.1.min.js"></script>
        <script>
    //Función para ejecutar una consulta para registrar al usuario en la base de datos
    function checkRegistro() {
        // Asignamos los valores de los campos del formulario
        var nombre = $("#nombre").val();
        var apellido = $("#apellido").val();
        var tel = $("#telefono").val();
        var mail = $("#mail").val();
        var pass = $("#password").val();

        // En caso de que falten campos por llenar, se mostrará un mensaje de error
        if (nombre === "" || apellido === "" || tel === "" || mail === '' || pass === '') {
            $('#mensaje').html('Faltan campos por llenar...');
            setTimeout(function () {
                $('#mensaje').html('');
            }, 5000);
            return;
        }

        $.ajax({
            url: "funciones/valida_registro.php",
            type: "POST",
            data: {
                nombre: nombre,
                apellido: apellido,
                tel: tel,
                mail: mail,
                pass: pass
            },
            dataType: "text",
            success: function (res) {
                $('#mensaje').html('Usuario registrado con éxito');
                setTimeout(function () {
                    window.location.href = "index.html";
                }, 5000);
            },
            error: function () {
                alert("Error al conectar al servidor...");
            }
        });
    }
</script>

    </head>
    <body>
        <form action="" name="registro" method="post">
            <h1>Registro de usuario</h1>
            <label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre(s)">
            </label>
            <label>
                <input type="text" name="apellido" id="apellido" placeholder="Apellidos">     
            </label>
            <label>
                <input type="text" id="telefono" placeholder="Telefono">
            </label>
            <label>
                <input type="text" id="mail" placeholder="Correo Electronico">
            </label>
            <label>
                <input type="password" id="password" placeholder="Contraseña">
            </label>
            <div id="mensaje"></div>            
            <div class="boton">
                <input type="button" class="btn" value="Registrar" onclick="checkRegistro();">
            </div>
        </form>
    </body>
</html>