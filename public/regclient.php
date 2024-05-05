<?php
session_start();
$id_u = $_SESSION['idU'];
?>
<html>
    <head>
        <title>Registro de cliente</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/pago_style.css">
        <script src="jquery-3.3.1.min.js"></script>
        <script>
            //Funcion para registrar pago en la base de datos
            function alta_cliente(){
                //asignamos valores a las variables
                var id_usuario = <?php echo $id_u; ?>;
                var nombre    = $("#nombre").val();
                var apellido  = $("#apellido").val();
                var correo    = $("#correo").val();
                var telefono  = $("#telefono").val();
                var direccion = $("#direccion").val();

                if(nombre === "" || apellido === "" || correo === "" || telefono === "" || direccion === ""){
                    $('#mensaje').html('Faltan campos por llenar...');
                    setTimeout(function () {
                        $('#mensaje').html('');
                        }, 5000);
                    return;
                }

                $.ajax({
                    url: "funciones/alta_cliente.php",
                    type: "POST",
                    data: {
                        id_usuario: id_usuario,
                        nombre: nombre,
                        apellido: apellido,
                        correo: correo,
                        telefono: telefono,
                        direccion: direccion,
                    },
                    dataType: "text",
                    success: function (res) {
                        if (res) {
                            $('#mensaje').html('Cliente registrado con éxito');
                            setTimeout(function () {
                                window.close();
                            },3000);
                        
                        } else {
                            $('#mensaje').html('Cliente no pudo ser registrado');
                        }
                        
                        
                    },
                    error: function () {
                        alert("Error al conectar al servidor...");
                    }
                })
            }
        </script>

    </head>
<body>
    <form action="" name="Cliente" method="post">
        <h2>Registrar Cliente</h2>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del cliente">

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" placeholder="Ingrese el apellido del cliente">

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" placeholder="Ingrese el correo electrónico del cliente">

        <label for="telefono">Teléfono (10 digitos):</label>
        <input type="text" id="telefono" name="telefono" placeholder="Ingrese el teléfono del cliente">

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" placeholder="Ingrese la dirección del cliente">

        <div id="mensaje"></div>

        <div class="boton">
            <input type="button" class="btn" value="Registrar" onclick="alta_cliente();">
        </div>
    </form>
</body>
</html>