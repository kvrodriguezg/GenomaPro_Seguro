<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/estados_model.php";
require_once $ruta;

$rutap = dirname($directorioActual) . "/Models/perfilesModel.php";
require_once $rutap;
$objetoEstado = new Estados();
$objetoPerfiles = new perfiles();
$DetallePerfiles = $objetoPerfiles->verPerfiles();

/* if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']))
{
    $boton = "Enviar";
    $id = $_POST['estadoID'];
    if ($id>0){
        $idEstados= $id;
        $esta = $objetoEstado->buscarEstadoPorID($id);
        $codigo = $bjetoPerfiles->;
        $nombreCentro = $centros['NombreCentro'];
        $operacion = "Modificar";
        $titulo = "Editar:";
    }
    else if ($id==0)
    {
        $IDCentroMedico = 0;
        $codigo = "";
        $nombreCentro = "";
        $operacion = "Guardar";
        $titulo = "Nuevo Centro Médico:";
    }
} */
//nuevo
if (isset($_POST['op']) && $_POST['op'] == "GUARDAR" && isset($_POST['IDEstado']) && isset($_POST['AgregaNEstado']) && isset($_POST['IDPerfil'])) {

    $NombreEstado = $_POST['AgregaNEstado'] ?? '';
    $IdPerfil = $_POST['IDPerfil'] ?? '';

    $insertar = $objetoEstado->InsertaEstado($NombreEstado, $IdPerfil);

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


// Eliminar perfil 
if (isset($_POST['op']) && $_POST['op'] == "eliminar" && isset($_POST['IDEstado'])) {
    $IDEstado = $_POST['IDEstado'];
    $borrarestado = $objetoEstado->EliminaEstado($IDEstado);

    $alertaExito = $borrarestado ? 'true' : 'false';

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



if (isset($_POST['op']) && $_POST['op'] == "Modificar" && isset($_POST['IDEstado']) && isset($_POST['AgregaNEstado']) && isset($_POST['IDPerfil'])) {
    $IDEstado = $_POST['IDEstado'] ?? '';
    $NombreEstado = $_POST['AgregaNEstado'] ?? '';
    $IdPerfil = $_POST['IDPerfil'] ?? '';
    $op = $_POST['op'] ?? '';
    $insertar = $objetoEstado->ModificarEstado($NombreEstado, $IdPerfil, $IDEstado);


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

if (isset($_POST['estadoID'])) {
    $IDEstado = (int)$_POST['estadoID'];

    if ($IDEstado != 0) {
        $datosEstado = $objetoEstado->buscarEstadoPorID($IDEstado);
        $AgregaNEstado = $datosEstado['NombreEstado'];
        $perfilSelecionado = $datosEstado['IDPerfil'];
        $modalTitle = "Editar:";
        $op = "Modificar";
    } else {
        $AgregaNEstado = "";
        $perfilSelecionado = "";
        $modalTitle = "Nuevo Estado:";
        $op = "GUARDAR";
    }
}
$DetalleEstados = $objetoEstado->MostrarEstados();
