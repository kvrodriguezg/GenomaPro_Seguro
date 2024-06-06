<?php
$directorioActual = __DIR__;
$rutaPdf = dirname($directorioActual) . "../Controllers/pdfController.php";
require_once $rutaPdf;
$rutaexamenes = dirname($directorioActual) . "../Controllers/examenesController.php";
require_once $rutaexamenes;

$rutaTCPDF = dirname($directorioActual) . "/TCPDF-main/tcpdf.php";
require_once $rutaTCPDF;


// Crear una instancia de TCPDF
$pdf = new TCPDF();

// Agregar una nueva página al PDF
$pdf->AddPage();

// Definir el contenido del PDF
$logoPath = '../img/1.png';  // Ruta a tu logo
$firmaDigital = '../img/Firma.png'; //Ruta Firma Digital Director Técnico
$fechaImpresion = date("Y-m-d H:i:s");  // Fecha de impresión actual

// Aquí deberías obtener los datos del paciente y el diagnóstico desde la base de datos
$nombrePaciente = $detallePdf['NombreDelPaciente'];
$rutPaciente = $detallePdf['RutPaciente'];
$descripcionDiagnostico = $detallePdf['DescripcionDiagnostico']; // $DetallePdf[''];  //"Descripción del Diagnóstico desde la base de datos";
$fechaTomaMuestra = $detallePdf['FechaTomaMuestra'];
$fechaRecepcionExamen = $detallePdf['FechaRecepcion'];
$fechaDiagnostico = $detallePdf['Fechadiagnostico'];
$Diagnostico = $detallePdf['CodigoDiagnosticos'];

// Configurar el contenido del PDF


$html = '<table width="100%">
        <tr><br>
            <td><img src="' . $logoPath . '" width="80"></td>
            <td align="right">
                <strong>Nombre del Paciente:</strong> ' . $nombrePaciente . '<br>
                <strong>RUT del Paciente:</strong> ' . $rutPaciente . '
            </td>
        </tr>
        <br>
        <br>
        <tr>
            <td colspan="2" align="center"><h2>Informe de Diagnóstico</h2></td>
        </tr>

       <br>
        <tr>
            <td ><strong>Fecha de toma de muestra:</strong></td>
            <td >' . $fechaTomaMuestra . '</td>
        </tr>
        <tr>
            <td><strong>Fecha de recepción de examen:</strong></td>
            <td>' . $fechaRecepcionExamen . '</td>
        </tr>
        <tr>
            <td><strong>Fecha de impresión :</strong> </td>
            <td>' . $fechaImpresion . '</td>
        </tr>
    <tr>
    <td><strong>Fecha de Análisis Diagnóstico :</strong> </td>
    <td>' . $fechaDiagnostico . '</td>
</tr>
        </table>
        <br>
        <strong>Diagnóstico:  </strong>' . $Diagnostico . '<br><br>
    <strong>Descripción del Diagnóstico:</strong>
    <br>
    <br>
    <div >
       <textarea name="TextIngreso" rows="20" cols="80" >' . $descripcionDiagnostico . '</textarea>
    </div>
    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>
    <br>
    <div  style="width: 90%; text-align: center;">
    <img src="' . $firmaDigital . '" width="80">
    <h6>Luis Yañez Carreño </h6>
    <h6>Director Técnico </h6>
    </div>

    <Footer text-align="center">
    <hr>
            <strong><br>Laboratorio LABMUEST : Evaluación y Diagnóstico de Exámenes</strong>
    </Footer>';


// Agregar el contenido al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Nombre del archivo PDF
$nombreArchivo = 'informe_diagnostico' . $rutPaciente . '.pdf';
ob_end_clean();
// Salida del PDF (puedes elegir descargarlo o mostrarlo en el navegador)
$pdf->Output($nombreArchivo, 'I');//muestra en pantalla
//$pdf->Output($nombreArchivo, 'D');descarga automaticamente.
?>