<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$directorioActual = __DIR__;
$rutausuario = dirname($directorioActual) . "/Models/usuarioModel.php";
$rutaModel = dirname($directorioActual) . "/Models/perfilesModel.php";
require_once $rutausuario;
require_once $rutaModel;
$objusuario = new usuario();
$objPerfil = new Perfiles();

$listperfiles = $objPerfil->vertipoPerfiles();
$listcentros = $objusuario->verCentrosarray();
$listusuarios = $objusuario->verUsuarios();

if (isset($_POST['op']) && $_POST['op'] == "GUARDAR" && isset($_POST['nombre']) && isset($_POST['rut']) && isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['correo']) && isset($_POST['perfil']) && isset($_POST['centro'])) {

    $nombre = $_POST['nombre'] ?? '';
    $rut = $_POST['rut'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $perfil = $_POST['perfil'] ?? '';
    $centro = $_POST['centro'] ?? '';
    $op = $_POST['op'] ?? '';
	$idPerfil= $objusuario->buscarPerfil($perfil);
	$idCentroMedico= $objusuario->buscarcentro($centro);
    $insertar = $objusuario->insertarUsuario($usuario, $nombre, $correo, $rut, $clave, $idPerfil, $idCentroMedico);

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
if (isset($_POST['op']) && $_POST['op'] == "eliminar" && isset($_POST['IDUsuarioEliminar'])) {
    $IDUsuario = $_POST['IDUsuarioEliminar'];
    $borrarusuario = $objusuario->eliminarUsuario($IDUsuario);

    $alertaExito = $borrarusuario ? 'true' : 'false';

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


if (isset($_POST['op']) && $_POST['op'] == "Modificar" && isset($_POST['IDUsuario']) && isset($_POST['nombre']) && isset($_POST['rut']) && isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['correo']) && isset($_POST['perfil']) && isset($_POST['centro'])) {
    $IDUsuario = $_POST['IDUsuario'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $rut = $_POST['rut'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $perfilM = $_POST['perfil'] ?? '';
    $centroM = $_POST['centro'] ?? '';
    $op = $_POST['op'] ?? '';
	//incorporar aca la llamada a la funcion que limpia los datos
    $idPerfilM= $objusuario->buscarPerfil($perfilM);
    $idCentroMedicoM= $objusuario->buscarcentro($centroM);
    $insertar = $objusuario->modificarPerfil($IDUsuario, $usuario, $nombre, $correo, $rut, $clave, $idPerfilM, $idCentroMedicoM);

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

$listusuarios = $objusuario->verUsuarios();
