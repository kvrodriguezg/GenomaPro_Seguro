<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/examenesModel.php";
require_once $ruta;
//include("../Models/examenesModel.php");
$examen = new examenesModel();

if (isset($_POST['actualizarEstado'])) {
    $idExamen = $_POST['idExamen'];
    $idEstado = $_POST['estado'];
    $examen->cambiarEstado($idEstado, $idExamen);
    header("Location: recepcion.php");
    exit;
}

if (isset($_POST['actualizarEstadoDiagnostico'])) {
    $idExamen = $_POST['idExamen'];
    $idEstado = $_POST['estado'];
    $diagnostico = $_POST['diagnostico'];
    $examen->cambiarEstado($idEstado, $idExamen);
    $examen->actualizarDiagnostico($idExamen, $diagnostico);
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['actualizarEstadoTincion'])) {
    $idExamen = $_POST['idExamen'];
    $idEstado = $_POST['estado'];
    $examen->actualizarTincion($idExamen, $idEstado);
    header("Location: " . $_SERVER['HTTP_REFERER']);
}


if (isset($_POST['eliminarRegistro'])) {
    $idExamen = $_POST['idExamen'];
    $examen->eliminarRegistro($idExamen);
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['cambiarEstadoMasivo'])) {
    $seleccionados = $_POST['seleccionados'];
    $idEstado = $_POST['estado'];

    foreach ($seleccionados as $idExamen) {
        $examen->cambiarEstado($idEstado, $idExamen);
    }

    header("Location: recepcion.php");
    exit;
}

if (isset($_POST['cambiarEstadotincion'])) {
    $seleccionados = $_POST['seleccionados'];
    $idEstado = $_POST['estado'];

    foreach ($seleccionados as $idExamen) {
        $examen->cambiarEstado($idEstado, $idExamen);
    }

    header("Location: tincion.php");
    exit;
}


if (isset($_POST['cambiarEstadodiagnostico'])) {
    $seleccionados = $_POST['seleccionados'];
    $idEstado = $_POST['estado'];
    $diagnostico = $_POST['diagnostico'];
    foreach ($seleccionados as $idExamen) {
        $examen->cambiarEstado($idEstado, $idExamen);
        $examen->actualizarDiagnostico($idExamen, $diagnostico);
    }
    header("Location: diagnostico.php");
    exit;
}

if (isset($_POST['Filtrar'])) {
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];

    header("Location: descargarexcel.php?fechaInicio=$fechaInicio&fechaFin=$fechaFin");
}


if (!empty($_POST["ingreso"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["domicilio"]) && !empty($_POST["rut"]) && !empty($_POST["nombreexamen"]) && !empty($_POST["fechamuestra"])) {
        $nombre = $_POST["nombre"];
        $domicilio = $_POST["domicilio"];
        $nombreexamen = $_POST["nombreexamen"];
        $fechamuestra = $_POST["fechamuestra"];
        $fecharecepcion = $_POST["fecharecepcion"];
        $idcentro = $_POST["idcentro"];
        $rut = $_POST["rut"];

        $existePaciente = $examen->validarPaciente($rut);
        

        $estado = $examen->validarut($rut);

        if ($estado === "MAL") {
            echo 
            '<script>
                document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "RUT incorrecto.",
                            confirmButtonColor: "#023059"
                        });
                });
            </script>';
        } else {
            if ($existePaciente) {
                $domicilioActual = $examen->obtenerDomicilioPaciente($rut);
                if ($domicilioActual != $domicilio) {
                    $examen->actualizarDomicilioPaciente($rut, $domicilio);
                    echo
                    '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "success",
                            title: "Domicilio de paciente actualizado.",
                            confirmButtonColor: "#023059"
                        });
                    });
                    </script>';;
                }
            }
            if ($existePaciente == false) {
                $examen->insertarPaciente($nombre, $domicilio, $rut);
                $examen->insertarExamen($nombreexamen, $rut, $idcentro, $fechamuestra, $fecharecepcion);
                echo
                '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "success",
                            title: "Paciente registrado correctamente.",
                            confirmButtonColor: "#023059"
                        });
                    });
                </script>';;
            } else {
                $examen->insertarExamen($nombreexamen, $rut, $idcentro, $fechamuestra, $fecharecepcion);
                echo
                '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "success",
                            title: "Paciente ya existe. Se ha registrado el examen.",
                            confirmButtonColor: "#023059"
                        });
                    });
                </script>';                
            }
        }
    } else {
        echo 
        '<script>
            document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Algunos campos están vacíos.",
                        confirmButtonColor: "#023059"
                    });
            });
        </script>';
    }
}

$examenes = $examen->obtenerDatosExamenes();
$examenesTincion = $examen->obtenerExamenesTincion();
$examenesDiagnostico = $examen->obtenerExamenesDiagnosticos();
$examenesRegistro = $examen->obtenerExamenesRegistro();
$centrosmedicos = $examen->obtenerCentrosmedicos();
