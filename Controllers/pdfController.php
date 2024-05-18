<?php
//$directorioActual = __DIR__;
//$pdf = dirname($directorioActual) . "/Models/pdfModel.php";
//require_once $pdf;
include("../Models/pdfModel.php");

$objetoPdf = new PDF();

if (isset($_GET['id'])) {
    $IDExamen = $_GET['id'];

    $detallePdf = $objetoPdf->ObtenerDatosPdf($IDExamen);

    if ($detallePdf !== false) {
        if ($detallePdf !== null) {
            include('generar_pdf.php');
        } else {

            echo "No se encontraron datos para el IDExamen especificado.";
        }
    } else {

        echo "Error al obtener los datos del examen.";
    }
} else {
    echo "IDExamen no está seteado.";
}




?>
