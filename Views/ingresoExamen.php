<?php
$directorioActual = __DIR__;
$rutaacceso = dirname($directorioActual) . "/Controllers/accesoController.php";
require_once $rutaacceso;
$directorioActual = __DIR__;
$rutaexamenes = dirname($directorioActual) . "/Controllers/examenesController.php";
require_once $rutaexamenes;

//require_once("../Controllers/ExamenController.php");
//require_once('../Controllers/accesoController.php');
$perfilesPermitidos = 3;
verificarAcceso($perfilesPermitidos);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['nombre'])) {
        $nombre = '';
    } else {
        $nombre = $_POST['nombre'];
    }
    if (!isset($_POST['rut'])) {
        $rut = '';
    } else {
        $rut = $_POST['rut'];
    }
    if (!isset($_POST['domicilio'])) {
        $domicilio = '';
    } else {
        $domicilio = $_POST['domicilio'];
    }
    if (!isset($_POST['idcentromedico'])) {
        $idcentromedico = '';
    } else {
        $idcentromedico = $_POST['idcentromedico'];
    }
    if (!isset($_POST['nombreexamen'])) {
        $nombreexamen = '';
    } else {
        $nombreexamen = $_POST['nombreexamen'];
    }
    if (!isset($_POST['fechamuestra'])) {
        $fechamuestra = '';
    } else {
        $fechamuestra = $_POST['fechamuestra'];
    }
    if (!isset($_POST['fecharecepcion'])) {
        $fecharecepcion = '';
    } else {
        $fecharecepcion = $_POST['fecharecepcion'];
    }

}
include("../Controllers/ExamenController.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"/>

    <title>Ingreso Examen</title>
    <script>
        function agregarGuion() {
            var rutInput = document.getElementById('rut');
            var valorRut = rutInput.value.replace(/[^\dKk]/g, '');

            if (valorRut.length <= 10) {
                rutInput.value = formatearRut(valorRut);
            }
        }

        function formatearRut(rut) {
            if (rut.length > 1) {
                return rut.slice(0, -1) + '-' + rut.slice(-1);
            }
            return rut;
        }
    </script>


</head>

<body>
<header class="navbar navbar-light fixed-top" style="background-color: #9CD0FE;">
    <?php
    include("menurecepcionista.php");

    ?>
</header>
<br><br><br><br><br>
<h2 style="text-align: center;">Ingresar nueva orden</h2>
<form method="POST" class="form" style="padding: 100px 300px 0 300px;" action="ingresoExamen.php">

    <div class="row">
        <div class="col">
            <label for="nombrePaciente">Nombre Paciente</label>
            <input type="text" class="form-control" name="nombre">
        </div>
        <div class="col">
            <label for="rut">Rut</label>
            <input type="text" class="form-control" name="rut" id="rut"
                   oninput="agregarGuion()" maxlength="10" required>
        </div>


    </div>

    <br>

    <div class="row">
        <div class="col">
            <label for="domicilio">Domicilio</label>
            <input type="text" class="form-control" name="domicilio">
        </div>
        <div class="col">
            <label for="idcentromedico">Seleccionar Centro medico</label>
            <select class="form-control" name="idcentrosoli">
                <?php
                while ($row = mysqli_fetch_array($centrosmedicos)) {
                    echo "<option value=" . $row['IDCentroMedico'] . ">" . $row['NombreCentro'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    </div>

    <br>

    <div class="row">
        <div class="col">
            <label for="nombreExamen">Nombre Examen</label>
            <input type="text" class="form-control" name="nombreexamen">
        </div>
        <div class="col">
            <label for="fechaTomaMuestra">Fecha de Toma de Muestra</label>
            <input type="date" class="form-control" name="fechamuestra">
        </div>
    </div>

    <br>


    <br>
    <input type="hidden" name="fecharecepcion" value="<?php echo date('Y-m-d H:i:s'); ?>">
    <input type="hidden" name="ingreso" value="ingresado">
    <input type="submit" class="btn btn-primary w-100 center-block" name="btnregistrar" value="Registrar">

</form>
<script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>