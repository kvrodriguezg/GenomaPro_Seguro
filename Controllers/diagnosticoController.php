<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once("../Models/diagnosticoModel.php");
$objdiagnostico = new diagnosticos();

$codigo = "";
$descripcion = "";
if (isset($_POST['codigo'])) {
    if ($_POST['codigo'] != 0) {
        $codigo = $_POST['codigo'];
        $valorcodigo = $_POST['codigo'];
        $descripcion = $objdiagnostico->obtenerDescripcion($codigo);
        $operacion = "modificar";
        $readonly = "readonly";
        $boton = "Modificar";
        $titulo = "Editar:";
    } else if ($_POST['codigo'] == 0) {
        $codigo = 0;
        $valorcodigo = "";
        $descripcion = "";
        $operacion = "insertar";
        $boton = "Ingresar";
        $readonly = "";
        $titulo = "Nuevo Diagnóstico:";
    }
}

if (isset($_POST['operacion'])) {
    $operacion = $_POST['operacion'];
    $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";

    if ($operacion == "insertar")
    {
        $resultado = $objdiagnostico->insertarDiagnostico($codigo,$descripcion);

        echo 
        '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var resultado = ' . $resultado . ';
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
    else if ($operacion == "modificar")
    {
        $resultado = $objdiagnostico->editarDiagnostico($codigo,$descripcion);
        echo
        '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    var resultado = ' . $resultado . ';
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
    else if ($operacion == "eliminar")
    {
        //$codigoEliminar = isset($_POST['codigoEliminar']) ? $_POST['codigoEliminar'] : "";
        $resultado = $objdiagnostico->eliminarDiagnostico($codigo);
        echo
        '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    var resultado = ' . $resultado . ';
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
}

$diagnosticos = $objdiagnostico->verdiagnosticos();
