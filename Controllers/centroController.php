<?php
//$directorioActual = __DIR__;
//$rutacentro = dirname($directorioActual) . "/Models/centromedicoModel.php";
//require_once $rutacentro;
include("../Models/centromedicoModel.php");
//session_start();
$objCentros = new centromedico();
$idCentro = $_SESSION['idCentro'];
$listExamenes = $objCentros->buscarExamenes($idCentro);

$nombreCentro = $objCentros->nombreCentro($idCentro);
