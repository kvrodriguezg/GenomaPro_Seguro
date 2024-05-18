<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/reportesModel.php";
require_once $ruta;
//include("../Models/reportesModel.php");
$reporte = new ReportesModel();
$centrosMedicos = $reporte->obtenerNombresCentrosMedicos();
$diagnosticos = $reporte->obtenerNombresDiagnosticos();
$examenes = $reporte->obtenerNombresExamenes();