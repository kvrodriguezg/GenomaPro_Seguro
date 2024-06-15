<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

$directorioActual = __DIR__;
$rutausuario = dirname($directorioActual) . "/Models/usuarioModel.php";
$rutaModel = dirname($directorioActual) . "/Models/perfilesModel.php";
$Verify = dirname($directorioActual). "/Controllers/class/inputVerify.php";
require_once $Verify;
require_once $rutausuario;
require_once $rutaModel;
$objusuario = new usuario();
$objPerfil = new Perfiles();

$listperfiles = $objPerfil->vertipoPerfiles();
$listcentros = $objusuario->verCentrosarray();
$listusuarios = $objusuario->verUsuarios();

if (isset($_POST['op']) && $_POST['op'] == "GUARDAR" && isset($_POST['nombre']) && isset($_POST['rut']) && isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['correo']) && isset($_POST['perfil']) && isset($_POST['centro'])) {
        $postData = array(
            'nombre' => $_POST['nombre'],
            'rut' => $_POST['rut'],
            'usuario' => $_POST['usuario'],
            'clave' => $_POST['clave'],
            'correo' => $_POST['correo'],
            'perfil' => $_POST['perfil'],
            'centro' => $_POST['centro'],
        );

        $sanitizedData = sanitizeArray($postData);
        $nombre = $sanitizedData['nombre'] ?? '';
        $rut = $sanitizedData['rut'] ?? '';
        $usuario = $sanitizedData['usuario'] ?? '';
        $clave = $sanitizedData['clave'] ?? '';
        $correo = $sanitizedData['correo'] ?? '';
        $perfil = $sanitizedData['perfil'] ?? '';
        $centro = $sanitizedData['centro'] ?? '';
        $op = $_POST['op'] ?? '';
		$error = validateData($sanitizedData);

    if (!validateData($sanitizedData)) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Revise los datos ingresados",
                confirmButtonColor: "#023059"
            });
        });
      </script>';
	}
	else {
        $idPerfil = $objusuario->buscarPerfil($perfil);
        $idCentroMedico = $objusuario->buscarcentro($centro);
        $estado = $objusuario->validarut($rut);

        if ($estado == "BIEN") {
            $existeUsuario = $objusuario->buscarUsuarioPorLlaveForanea($rut);
            if ($existeUsuario != $rut) {
                $insertar = $objusuario->insertarUsuario($usuario, $nombre, $correo, $rut, $clave, $idPerfil, $idCentroMedico);
                if ($insertar) {
                    echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Creación exitosa!",
                        confirmButtonColor: "#023059"
                    });
                });
            </script>';
                } else {
                    echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Ocurrió un error!",
                        confirmButtonColor: "#023059"
                    });
                });
            </script>';
                }
            } else {
                echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "warning",
                    title: "No se puede insertar!",
                    text: "RUT ya existe.",
                    confirmButtonColor: "#023059"
                });
            });
        </script>';
            }
        } else {
            echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "warning",
                title: "No se puede insertar!",
                text: "RUT inválido.",
                confirmButtonColor: "#023059"
            });
        });
    </script>';
        }
    }
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

    $postData = array(
        'IDUsuario' => $_POST['IDUsuario'] ?? '',
        'nombre' => $_POST['nombre'] ?? '',
        'rut' => $_POST['rut'] ?? '',
        'usuario' => $_POST['usuario'] ?? '',
        'clave' => $_POST['clave'] ?? '',
        'correo' => $_POST['correo'] ?? '',
        'perfil' => $_POST['perfil'] ?? '',
        'centro' => $_POST['centro'] ?? '',
    );

    $sanitizedData = sanitizeArray($postData);

    $IDUsuario = $sanitizedData['IDUsuario'] ?? '';
    $nombre = $sanitizedData['nombre'] ?? '';
    $rut = $sanitizedData['rut'] ?? '';
    $usuario = $sanitizedData['usuario'] ?? '';
    $clave = $sanitizedData['clave'] ?? '';
    $correo = $sanitizedData['correo'] ?? '';
    $perfilM = $sanitizedData['perfil'] ?? '';
    $centroM = $sanitizedData['centro'] ?? '';

    $op = $_POST['op'] ?? '';
    if (!validateData($sanitizedData)) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Revise los datos ingresados",
                confirmButtonColor: "#023059"
            });
        });
      </script>';
    } else {
        $idPerfilM = $objusuario->buscarPerfil($perfilM);
        $idCentroMedicoM = $objusuario->buscarcentro($centroM);

        $insertar = $objusuario->modificarPerfil($IDUsuario, $usuario, $nombre, $correo, $rut, $clave, $idPerfilM, $idCentroMedicoM);

        if ($insertar) {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Modificación exitosa!",
                        confirmButtonColor: "#023059"
                    });
                });
            </script>';
        } else {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Ocurrió un error!",
                        confirmButtonColor: "#023059"
                    });
                });
            </script>';
        }
    }
}

$listusuarios = $objusuario->verUsuarios();
