<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "../Models/centromedicoModel.php";
require_once $ruta;
//include("../Models/centromedicoModel.php");
$objCentros = new CentroMedico();

// Creación de CENTRO si no existe
if (isset($_POST['crearcentros'])) {
    $objCentros->crearCentros();
}



if (isset($_POST['operacion']) && $_POST['operacion'] == "Guardar" && isset($_POST['nombreCentro']) && isset($_POST['codigo'])) {
    $nombreCentro = $_POST['nombreCentro'];
    $codigoCentro = $_POST['codigo'];
    $insertarCentro = $objCentros->insertarCentro($nombreCentro, $codigoCentro);

    echo
    '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var resultado = ' . $insertarCentro . ';
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


//EDITAR CENTRO
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['operacion']) && $_POST['operacion'] == "Modificar" && isset($_POST['IDCentroMedico']) && isset($_POST['nombreCentro']) && isset($_POST['codigo'])) {
    $nombreCentro = $_POST['nombreCentro'];
    $CodigoCentro = $_POST['codigo'];
    $IDCentroMedico = $_POST['IDCentroMedico'];
    $editarCentro = $objCentros->modificarCentro($IDCentroMedico, $nombreCentro, $CodigoCentro);
    echo
    '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var resultado = ' . $editarCentro . ';
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $boton = "Enviar";
    $id = $_POST['id'];
    if ($id > 0) {
        $IDCentroMedico = $id;
        $centros = $objCentros->buscarCentroPorID($id);
        $codigo = $centros['codigo'];
        $nombreCentro = $centros['NombreCentro'];
        $operacion = "Modificar";
        $titulo = "Editar:";
    } else if ($id == 0) {
        $IDCentroMedico = 0;
        $codigo = "";
        $nombreCentro = "";
        $operacion = "Guardar";
        $titulo = "Nuevo Centro Médico:";
    }
}



// Eliminar IDCentroMedico 
if (isset($_POST['op']) && $_POST['op'] == "ELIMINAR" && isset($_POST['IDCentroMedico'])) {
    $IDCentroMedico = $_POST['IDCentroMedico'];
    $borrarCentro = $objCentros->eliminarCentro($IDCentroMedico);
    echo
    '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var resultado = ' . $borrarCentro . ';
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

$listCentros = $objCentros->verCentros();
