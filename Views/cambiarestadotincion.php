<?php
//directorioActual = __DIR__;
//rutaacceso = dirname($directorioActual) . "/Controllers/accesoController.php";
//equire_once $rutaacceso;
//
//directorioActual = __DIR__;
//rutaexamenes = dirname($directorioActual) . "/Controllers/examenesController.php";
//equire_once $rutaexamenes;

require_once("../Controllers/examenesController.php"); 
require_once('../Controllers/accesoController.php');

$perfilesPermitidos = 2;
verificarAcceso($perfilesPermitidos);

$seleccionados = $_POST['seleccionados'] ?? "";
$idEstado = $_POST['estado'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Tinción</title>
</head>

<body class="container">
    <header class="navbar navbar-light fixed-top" style="background-color: #9CD0FE;">
        <?php
        include("menutincion.php");
        ?>
    </header>
    <br><br><br><br><br>

    <h1>Cambio de Estado Masivo</h1><br>
    <br>
    <br>
    <section>
        <form method="post" action="cambiarestadotincion.php">
            <select class="form-select" style="width: 150px" name="estado" required>
                <?php
                $resultadoEstados = $examen->obtenerEstados('tincion');
                while ($row1 = mysqli_fetch_array($resultadoEstados)) {
                    echo '<option value="' . $row1['IDEstado'] . '">' . $row1['NombreEstado'] . '</option>';
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary" name="cambiarEstadotincion">Cambiar Estado Masivo</button>
            <br> <br>
            <table id="tableUsers" class="tabla table">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>ID Examen</th>
                        <th>Nombre Paciente</th>
                        <th>Domicilio</th>
                        <th>Laboratorio</th>
                        <th>Examen</th>
                        <th>F. Toma de Muestra</th>
                        <th>F. de Tinción</th>
                        <th>F. Diagnóstico</th>
                        <th>Diagnóstico</th>
                        <th>Cod. Diagnóstico</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($examenesTincion)) { ?>
                        <tr class="table table-striped">
                            <form method="post" action="tincion.php">
                                <td>
                                    <input class="form-check-input" type="checkbox" name="seleccionados[]" value="<?php echo $row['IDExamen']; ?>" id="flexCheckIndeterminate">
                                </td>
                                <td><?php echo $row['IDExamen'] ?></td>
                                <td><?php echo $examen->obtenerNombrePaciente($row['RutPaciente']) ?></td>
                                <td><?php echo $examen->obtenerDomicilioPaciente($row['RutPaciente']) ?></td>
                                <td><?php echo $examen->obtenerCentroMedico($row['IDCentroSolicitante']) ?></td>
                                <td><?php echo $row['NombreExamen'] ?></td>
                                <td><?php echo $row['FechaTomaMuestra'] ?></td>
                                <td><?php echo $row['Fechatincion'] ?></td>
                                <td><?php echo $row['Fechadiagnostico'] ?></td>
                                <td><?php echo $examen->obtenerDiagnostico($row['CodigoDiagnosticos']); ?></td>
                                <td><?php echo $row['CodigoDiagnosticos']; ?></td>
                                <td><?php echo $examen->obtenerEstadoActual($row['IDEstado']); ?></td>
                        </tr>
                    <?php } ?>
        </form>


        </tbody>


        </table>
    </section>

    <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>