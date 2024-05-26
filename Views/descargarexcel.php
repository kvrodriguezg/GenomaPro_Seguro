<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=examenesfiltro.xls");
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;

$fechaInicio = mysqli_real_escape_string(Conectarse(), $_GET['fechaInicio'] ?? '');
$fechaFin = mysqli_real_escape_string(Conectarse(), $_GET['fechaFin'] ?? '');

$query = "SELECT * FROM Examenes WHERE FechaTomaMuestra BETWEEN '$fechaInicio' AND '$fechaFin'";
$resultados = mysqli_query(Conectarse(), $query);

?>

<table id="pruebas2">
    <thead>
    <tr>
        <th>ID Examen</th>
        <th>Nombre Examen</th>
        <th>Rut Paciente</th>
        <th>ID Centro Solicitante</th>
        <th>ID Estado</th>
        <th>Código Diagnóstico</th>
        <th>Fecha Toma Muestra</th>
        <th>Fecha Recepción</th>
        <th>Fecha Tinción</th>
        <th>Fecha Diagnóstico</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_array($resultados)) { ?>
        <tr class="table table-striped">
            <td><?php echo $row['IDExamen'] ?></td>
            <td><?php echo $row['NombreExamen'] ?></td>
            <td><?php echo $row['RutPaciente'] ?></td>
            <td><?php echo $row['IDCentroSolicitante'] ?></td>
            <td><?php echo $row['IDEstado'] ?></td>
            <td><?php echo $row['CodigoDiagnosticos'] ?></td>
            <td><?php echo $row['FechaTomaMuestra'] ?></td>
            <td><?php echo $row['FechaRecepcion'] ?></td>
            <td><?php echo $row['Fechatincion'] ?></td>
            <td><?php echo $row['Fechadiagnostico'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
