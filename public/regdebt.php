<html>
    <head>
        <title>Registro de usuario</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/pago_style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>        
        <script>
            function alta_deuda(){
                var id_cliente = $("#id_cliente").val();
                var fecha = $("#fecha_deuda").val();
                var monto = $("#monto_deuda").val();
                var status = $("#status").val();

                if(id_cliente === "" || fecha === "" || monto === "" || status === ""){
                    $('#mensaje').html('Faltan campos por llenar...');
                    setTimeout(function () {
                        $('#mensaje').html('');
                        }, 5000);
                    return;
                }

                $.ajax({
                    url: "funciones/alta_deuda.php",
                    type: "POST",
                    data: {
                        id_cliente: id_cliente,
                        fecha: fecha,
                        monto: monto,
                        status: status,
                    },
                    dataType: "text",
                    success: function (res) {
                        if (res) {
                            $('#mensaje').html('Deuda registrada con éxito');
                            setTimeout(function () {
                                window.close();
                            }, 3000);
                        
                        } else {
                            $('#mensaje').html('Deuda no pudo ser registrada');
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
        <form action="" name="registro_deuda" method="post">
            <h2>Registrar Deuda</h2>
            <label for="id_cliente">ID Cliente:</label>
            <input type="text" id="id_cliente" name="id_cliente" placeholder="Ingrese el ID del cliente">

            <label for="fecha_deuda">Fecha de deuda:</label>
            <input type="date" id="fecha_deuda" name="fecha_deuda">

            <label for="monto_deuda">Monto de la deuda:</label>
            <input type="number" id="monto_deuda" name="monto_deuda" min="0" step="0.01">

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="0" selected>Selecciona</option>
                <option value="1">Pendiente</option>
                <option value="2">Pagada</option>
            </select>

            <div id="mensaje"></div>

            <div class="boton">
                <input type="button" class="btn" value="Registrar" onclick="alta_deuda();">
            </div>
        </form>
    </body>
</html>