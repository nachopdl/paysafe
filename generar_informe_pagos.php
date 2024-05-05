<?php
require_once('tcpdf/tcpdf.php'); // Ruta a la biblioteca TCPDF
require "funciones/conecta.php";
$con = conecta();

// Obtener la fecha actual y la fecha de hace quince días
$fechaActual = date('Y-m-d');
$fecha15DiasAtras = date('Y-m-d', strtotime('-15 days'));

// Consulta SQL para obtener los datos de la tabla pagos en los últimos quince días
$sql = "SELECT id_cliente, fecha_pago, monto_pago, descripcion,
               CASE
                   WHEN categoria = 1 THEN 'Efectivo'
                   WHEN categoria = 2 THEN 'Transacción'
                   ELSE categoria
               END AS categoria_nombre
        FROM pagos 
        WHERE fecha_pago BETWEEN '$fecha15DiasAtras' AND '$fechaActual'
        ORDER BY fecha_pago ASC";
$result = $con->query($sql);

// Crear un nuevo objeto TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Autor');
$pdf->SetTitle('Informe de Pagos');
$pdf->SetSubject('Informe de Pagos');
$pdf->SetKeywords('TCPDF, PDF, informe, pagos');

// Agregar una página
$pdf->AddPage();

$imageFile = 'images/logo.png'; // Ruta de la imagen
$pdf->Image($imageFile, 10, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


// Crear el contenido del informe en PDF con estilos CSS
$html = '<h1 style="text-align: center;">Informe de Pagos</h1>';
$html .= '<table border="1" style="border-collapse: collapse; width: 100%;">
            <tr style="background-color: #f2f2f2;">
                <th>ID Cliente</th>
                <th>Fecha de Pago</th>
                <th>Monto de Pago</th>
                <th>Descripción</th>
                <th>Categoría</th>
            </tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row["id_cliente"] . '</td>
                    <td>' . $row["fecha_pago"] . '</td>
                    <td>' . $row["monto_pago"] . '</td>
                    <td>' . $row["descripcion"] . '</td>
                    <td>' . $row["categoria_nombre"] . '</td>
                  </tr>';
    }
} else {
    $html .= '<tr><td colspan="5" style="text-align: center;">No se encontraron resultados.</td></tr>';
}

$html .= '</table>';

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Generar el PDF como descarga
$pdf->Output('Informe_de_Pagos.pdf', 'D');

// Cerrar la conexión a la base de datos
$con->close();
?>
