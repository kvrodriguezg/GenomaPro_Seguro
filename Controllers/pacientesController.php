<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$rutap = dirname($directorioActual) . "/Models/pacientesModel.php";
require_once $rutap;

$objetoPaciente = new paciente();



if (isset($_POST['op']) && $_POST['op'] == "GUARDAR"  && isset($_POST['nombre']) && isset($_POST['Rut']) && isset($_POST['domicilio']) && isset($_POST['PacienteId'])) {

    $nombre = $_POST['nombre'] ?? '';
    $rut = $_POST['Rut'] ?? '';
    $domicilio = $_POST['domicilio'] ?? '';
    $estado = $objetoPaciente->validarut($rut);

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
        $insertar = $objetoPaciente->InsertarPaciente($rut, $nombre, $domicilio);

        //Se mostrará la alerta según el caso.
        $alertaExito = $insertar ? 'true' : 'false';

        echo
        '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    var resultado = ' . $alertaExito . ';
                    if (resultado) {
                        Swal.fire({
                            icon: "success",
                            title: "Creación exitosa!",
                            confirmButtonColor: "#023059"
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ocurrió un error!",
                            confirmButtonColor: "#023059"
                        });
                    }
                });
        </script>';
    }
}


// Eliminar paciente 
if (isset($_POST['op']) && $_POST['op'] == "eliminar" && isset($_POST['RutPaciente'])) {
    $rutPaciente = $_POST['RutPaciente'];
    $borrarpaciente = $objetoPaciente->EliminarPaciente($rutPaciente);

    $alertaExito = $borrarpaciente ? 'true' : 'false';

    echo
    '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var resultado = ' . $alertaExito . ';
                if (resultado) {
                    Swal.fire({
                        icon: "success",
                        title: "Eliminado!",
                        confirmButtonColor: "#023059"
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Ocurrió un error!",
                        confirmButtonColor: "#023059"
                    });
                }
            });
        </script>';
}



if (isset($_POST['op']) && $_POST['op'] == "Modificar" && isset($_POST['nombre']) && isset($_POST['Rut']) && isset($_POST['domicilio']) && isset($_POST['PacienteId'])) {
    $PacienteId = $_POST['PacienteId'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $domicilio = $_POST['domicilio'] ?? '';
    $rutNuevo = $_POST['Rut'] ?? '';
    $insertar = $objetoPaciente->ModificarPaciente($nombre, $rutNuevo, $domicilio, $PacienteId);


    $alertaExito = $insertar ? 'true' : 'false';

    echo
    '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var resultado = ' . $alertaExito . ';
                if (resultado) {
                    Swal.fire({
                        icon: "success",
                        title: "Actualizado con éxito!",
                        confirmButtonColor: "#023059"
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Ocurrió un error!",
                        confirmButtonColor: "#023059"
                    });
                }
            });
     </script>';
}

if (isset($_POST['PacienteId'])) {
    $PacienteId = $_POST['PacienteId'];

    if ($PacienteId != 0) {
        $datosPaciente = $objetoPaciente->buscarPacientePorRut($PacienteId);
        $rut = $datosPaciente['RutPaciente'];
        $nombre = $datosPaciente['NombrePaciente'];
        $domicilio = $datosPaciente['DomicilioPaciente'];
        $modalTitle = "Editar:";
        $op = "Modificar";
        $readonly = " readonly ";
    } else {
        $rut = "";
        $nombre = "";
        $domicilio = "";
        $modalTitle = "Nuevo Paciente:";
        $op = "GUARDAR";
        $readonly = "";
    }
}
$listpacientes = $objetoPaciente->MostrarPacientes();
