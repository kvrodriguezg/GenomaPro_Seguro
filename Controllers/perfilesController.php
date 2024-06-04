<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$directorioActual = __DIR__;
$rutaperfiles = dirname($directorioActual) . "/Models/perfilesModel.php";
require_once $rutaperfiles;


$objPerfil = new Perfiles();


// Creación de perfiles si no existe
if (isset($_POST['crearPerfiles'])) {
    $objPerfil->crearperfiles();
    header("Location: mantenedorPerfiles.php");
    exit();
}

if (isset($_POST['op']) && $_POST['op'] == "GUARDAR" && isset($_POST['tipoPerfil'])) {

    $tipoPerfil = $_POST['tipoPerfil'];
    $insertarperfil = $objPerfil->insertarPerfil($tipoPerfil);
    echo
    '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var resultado = ' . $insertarperfil . ';
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

if (isset($_POST['op']) && $_POST['op'] == "eliminar" && isset($_POST['IDPerfil'])) {
    $IDPerfil = $_POST['IDPerfil'];
    $borrarPerfil = $objPerfil->eliminarPerfil($IDPerfil);
    $alertaExito = $borrarPerfil ? 'true' : 'false';

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

if (isset($_POST['op']) && $_POST['op'] == "Modificar" && isset($_POST['IDPerfil']) && isset($_POST['tipoPerfil'])) {
    $idPerfil = $_POST['IDPerfil'] ?? '';;
    $tipoPerfil = $_POST['tipoPerfil'] ?? '';;
    $editarPerfil = $objPerfil->modificarPerfil($idPerfil, $tipoPerfil);

    echo
    '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var resultado = ' . $editarPerfil . ';
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

if (isset($_POST['PerfilId'])) {

    $idPerfil = $_POST['PerfilId'];
    if ($idPerfil != 0) {
        $tipoPerfil = $objPerfil->buscarPerfil($idPerfil);
        $modalTitle = "Editar:";
        $operacion = "Modificar";
    } else {
        $tipoPerfil = "";
        $modalTitle = "Nuevo Perfil:";
        $operacion = "GUARDAR";
    }
}
// Ver perfiles
$listperfiles = $objPerfil->verPerfiles();
