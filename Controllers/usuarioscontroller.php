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


if (isset($_POST['op']) && $_POST['op'] == "GUARDAR" && isset($_POST['nombre']) && isset($_POST['rut']) && isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['correo']) && isset($_POST['perfil']) && isset($_POST['centro'])) {

    $nombre = $_POST['nombre'] ?? '';
    $rut = $_POST['rut'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $perfil = $_POST['perfil'] ?? '';
    $centro = $_POST['centro'] ?? '';
    $op = $_POST['op'] ?? '';
    $estado = $objusuario->validarut($rut);
    if($estado=="BIEN"){
        $existeUsuario = $objusuario->buscarUsuarioPorLlaveForanea($rut);
        if ($existeUsuario != $rut)
        {
            $insertar = $objusuario->insertarUsuario($usuario, $nombre, $correo, $rut, $clave, $perfil, $centro);
            if ($insertar)
            {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Creación exitosa!",
                        confirmButtonColor: "#023059"
                    });
                });
            </script>';
            }
            else
            {
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
        else
        {
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
    }
    else{
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
    $existeUsuario = $objusuario->buscarUsuarioPorLlaveForanea($rut);
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $perfil = $_POST['perfil'] ?? '';
    $centro = $_POST['centro'] ?? '';
    $op = $_POST['op'] ?? '';
    $estado = $objusuario->validarut($rut);

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
    } 
    elseif($estado === "BIEN") {
        if ($existeUsuario) {

            if ($existeUsuario != $rut) {
                $objusuario->modificarPerfil($IDUsuario, $usuario, $nombre, $correo, $rut, $clave, $perfil, $centro);
                '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Datos modificados correctamente.",
                    confirmButtonColor: "#023059"
                });
            });
        </script>';
                
            }
        }
        if ($existeUsuario == false) {
            $objusuario->insertarUsuario($usuario, $nombre, $correo, $rut, $clave, $perfil, $centro);
            '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: " Usuario actualizado.",
                        confirmButtonColor: "#023059"
                    });
                });
                </script>';;
            exit();

        }
    }

}
    
 

$listusuarios = $objusuario->verUsuarios();
