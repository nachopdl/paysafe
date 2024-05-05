<?php
require_once('tcpdf/tcpdf.php'); // Ruta a la biblioteca TCPDF
require "funciones/conecta.php";
$con = conecta();

// Obtener la fecha actual y la fecha de hace quince días
$fechaActual = date('Y-m-d');
$fecha15DiasAtras = date('Y-m-d', strtotime('-15 days'));

// Consulta SQL para obtener los datos de la tabla deudas en los últimos quince días
$sql = "SELECT id_cliente, fecha_deuda, monto_deuda,
               CASE
                   WHEN status = 1 THEN 'Pendiente'
                   WHEN status = 2 THEN 'Pagada'
                   ELSE status
               END AS status_nombre
        FROM deudas 
        WHERE fecha_deuda BETWEEN '$fecha15DiasAtras' AND '$fechaActual'
        ORDER BY fecha_deuda ASC";
$result = $con->query($sql);

// Crear un nuevo objeto TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Autor');
$pdf->SetTitle('Informe de Deudas');
$pdf->SetSubject('Informe de Deudas');
$pdf->SetKeywords('TCPDF, PDF, informe, deudas');

// Agregar una página
$pdf->AddPage();

// Crear el contenido del informe en PDF con estilos CSS
$html = '<h1 style="text-align: center;">Informe de Deudas</h1>';
$html .= '<table border="1" style="border-collapse: collapse; width: 100%;">
            <tr style="background-color: #f2f2f2;">
                <th>ID Cliente</th>
                <th>Fecha de Deuda</th>
                <th>Monto de Deuda</th>
                <th>Status</th>
            </tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row["id_cliente"] . '</td>
                    <td>' . $row["fecha_deuda"] . '</td>
                    <td>' . $row["monto_deuda"] . '</td>
                    <td>' . $row["status_nombre"] . '</td>
                  </tr>';
    }
} else {
    $html .= '<tr><td colspan="4" style="text-align: center;">No se encontraron resultados.</td></tr>';
}

$html .= '</table>';

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Generar el PDF como descarga
$pdf->Output('Informe_de_Deudas.pdf', 'D');

// Cerrar la conexión a la base de datos
$con->close();
?>
