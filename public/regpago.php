<html>
    <head>
        <title>Registro de usuario</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/pago_style.css">
        <script src="jquery-3.3.1.min.js"></script>
        <script>
            //Funcion para registrar pago en la base de datos
            function alta_pago(){
                //asignamos valores a las variables
                var id_cliente  = $("#id_cliente").val();
                var fecha       = $("#fecha_pago").val();
                var monto       = $("#monto_pago").val();
                var descripcion = $("#descripcion").val();
                var category    = $("#category").val();

                if(id_cliente === "" || fecha === "" || monto === "" || descripcion === "" || category === ""){
                    $('#mensaje').html('Faltan campos por llenar...');
                    setTimeout(function () {
                        $('#mensaje').html('');
                        }, 5000);
                    return;
                }

                $.ajax({
                    url: "funciones/alta_pago.php",
                    type: "POST",
                    data: {
                        id_cliente: id_cliente,
                        fecha: fecha,
                        monto: monto,
                        descripcion: descripcion,
                        category:category,
                    },
                    dataType: "text",
                    success: function (res) {
                        if (res) {
                            $('#mensaje').html('Pago registrado con éxito');
                            setTimeout(function () {
                                window.close();
                            }, 3000);
                        
                        } else {
                            $('#mensaje').html('Pago no pudo ser registrado');
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
        <form action="" name="registro_pago" method="post">
            <h2>Registrar pago</h2>

            <label for="id_cliente">ID Cliente:</label>
            <input type="text" id="id_cliente" name="id_cliente" placeholder="Ingrese el ID del cliente">

            <label for="fecha_pago">Fecha de pago:</label>
            <input type="date" id="fecha_pago" name="fecha_pago">

            <label for="monto_pago">Monto del pago:</label>
            <input type="number" id="monto_pago" name="monto_pago" min="0" step="0.01">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea>
            
            <label for="category">Categoría:</label>
            <select id="category" name="category">
                <option value="0" selected>Selecciona</option>
                <option value="1">En efectivo</option>
                <option value="2">Transaccion</option>
            </select>

            <!-- Aquí puedes agregar más campos de entrada para recopilar información adicional del usuario, como su nombre, apellido, etc. -->

            <div id="mensaje"></div>

            <div class="boton">
                <input type="button" class="btn" value="Registrar" onclick="alta_pago();">
            </div>
        </form>
    </body>
</html>