<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$directorioActual = __DIR__;
$usuarioModel = dirname($directorioActual) . "/Models/existetablaModel.php";
require_once $usuarioModel;
$existe = new ExisteTabla();
$tablas = ["Perfiles", "Usuarios", "Estados", "CentrosMedicos", "Examenes", "Diagnosticos", "Pacientes"];
$validacionExistencia = true;

foreach ($tablas as $tabla) {
    $query = $existe->comprobarTabla($tabla);
    if (!$query) {
        $validacionExistencia = false;
    }
}

//Creacion de tablas si no existen.
if (isset($_POST['crearTabla'])) {
    $creacionadmin = false;
    $existe->crearTablas();
    $existe->crearCentros();
    $existe->crearDiagnosticos();
    $existe->crearPerfiles();
    $existe->crearEstados();
    if (!$existe->comprobarAdmin()) {
        $existe->crearUsuarioAdmin();
        $creacionadmin = true;
    }
    $validacionExistencia = true;

    if ($creacionadmin) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Tablas y usuario admin creados!",
                confirmButtonColor: "#023059"
            });
        });
    </script>';
    } else {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Tablas creadas!",
                confirmButtonColor: "#023059"
            });
        });
    </script>';
    }
    //return ("../index.php");
}

if ($existe->comprobarTabla("Usuarios")) {
    if (!$existe->comprobarAdmin()) {
        $validacionExistencia = false;
    }
}
