<?php
$directorioActual = __DIR__;
$rutareporte = dirname($directorioActual) . "../Controllers/reportesController.php";
$rutacceso = dirname($directorioActual) . "../Controllers/accesoController.php";
require_once($rutacceso);
require_once($rutareporte);
$perfilesPermitidos = 5;
verificarCodigo();
verificarAcceso($perfilesPermitidos); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/reporte.css">
    <title>Diagnósticos</title>
</head>
<header class="navbar navbar-light fixed-top" style="background-color: #FFFFFF;">
    <?php
    include_once("../Views/Shared/nav.php");
    ?>
</header>

<br><br><br><br><br>

<body class="text-center" style="background-color: #E7E7E7; font-family: 'Montserrat';">
    <div style="width:100%; display:flex; justify-content:center;">
        <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;" class="text-center">
            <i class="fa-regular fa-file fa-2xl" style="color: #FFFFFF;"></i>
        </div>
    </div>
    <h1 class='text-center' style="padding-top: 20px;">Exámenes por Centro Médico</h1>
    <div class="table-container">
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Centro Médico</th>
                    <?php
                    $totalFinal = 0;
                    foreach ($examenes as $examen) { ?>
                        <th><?php echo $examen; ?></th>
                    <?php } ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($centrosMedicos as $centroMedico) { ?>
                    <tr>
                        <td><?php echo $centroMedico; ?></td>
                        <?php
                        $totalExamenesCentro = 0;

                        foreach ($examenes as $examen) {
                            $cantidad = $reporte->obtenerCantidadExamenesPorCentro($centroMedico, $examen);
                            $totalExamenesCentro += $cantidad;
                        }

                        foreach ($examenes as $examen) {
                            $cantidad = $reporte->obtenerCantidadExamenesPorCentro($centroMedico, $examen);
                            $porcentaje = 0;
                            if ($totalExamenesCentro > 0) {
                                $porcentaje = ($cantidad / $totalExamenesCentro) * 100;
                            }
                        ?>
                            <td>
                                <?php echo $cantidad; ?>
                                (<?php echo round($porcentaje, 2); ?>%)
                            </td>
                        <?php } ?>
                        <td><?php echo $totalExamenesCentro;
                            $totalFinal += $totalExamenesCentro;
                            ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <h2>Total Exámenes: <?php echo $totalFinal ?></h2>
    <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
</body>

</html>