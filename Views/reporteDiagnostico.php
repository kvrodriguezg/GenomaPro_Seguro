<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Controllers/reportesController.php";
require_once $ruta;
//require_once("../Controllers/reportesController.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Diagnósticos por Centro Médico</title>
</head>

<body class="container">
    <header class="navbar navbar-light fixed-top" style="background-color: #9CD0FE;">
        <?php
        include("menuadministrador.php");
        ?>
    </header>

    <br><br><br><br><br>
    <section class="tablas_mantenedor">
        <h1 class='text-center' style="padding-top: 20px;">Diagnósticos por Centro Médico</h1><br>
        <table id="tableUsers" class="tabla table">
            <thead>
                <tr>
                    <th>Centro Médico</th>
                    <?php foreach ($diagnosticos as $diagnostico) { ?>
                        <th><?php echo $diagnostico; ?></th>
                    <?php } ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalFinal = 0;
                foreach ($centrosMedicos as $centroMedico) { ?>
                    <tr>
                        <td><?php echo $centroMedico; ?></td>
                        <?php
                        $totalDiagnosticoCentro = 0;


                        foreach ($diagnosticos as $diagnostico) {
                            $cantidad = $reporte->obtenerCantidadDiagnosticoPorCentro($centroMedico, $diagnostico);
                            $totalDiagnosticoCentro += $cantidad;
                        }

                        foreach ($diagnosticos as $diagnostico) {
                            $cantidad = $reporte->obtenerCantidadDiagnosticoPorCentro($centroMedico, $diagnostico);
                            $porcentaje = 0;
                            if ($totalDiagnosticoCentro > 0) {
                                $porcentaje = ($cantidad / $totalDiagnosticoCentro) * 100;
                            }
                        ?>
                            <td>
                                <?php echo $cantidad; ?>
                                (<?php echo round($porcentaje, 2); ?>%)
                            </td>
                        <?php } ?>
                        <td><?php echo $totalDiagnosticoCentro;
                            $totalFinal += $totalDiagnosticoCentro;
                            ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
    <h2>Total Diagnósticos: <?php echo $totalFinal?></h2>


    <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
  
</body>

</html>