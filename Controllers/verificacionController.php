<?php
$directorioActual = __DIR__;
$rutausuario = dirname($directorioActual) . "/Models/usuarioModel.php";
require_once $rutausuario;

$objlogin = new usuario();
session_start();

if (!isset($_SESSION['codigo_verificacion']) || empty($_SESSION['codigo_verificacion'])) {
    // Si no hay un código de verificación en la sesión, redirigir al usuario a la página de verificación
    header('Location: ../Views/verificacion.php');
    exit();
}
// Verificar si se ha enviado el formulario de verificación y el código ingresado es correcto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['op']) && $_POST['op'] == "VERIFICAR") {
    if (isset($_POST['codigo']) && !empty($_POST['codigo'])) {
        $codigoIngresado = $_POST['codigo'];
        if (isset($_SESSION['codigo_verificacion'])) {
            $codigoGuardado = $_SESSION['codigo_verificacion'];
            if ($codigoIngresado == $codigoGuardado) {
                $_SESSION['estado-verificacion']=1;

                $objlogin->eliminarCodigo($codigoGuardado);
                // Redireccionar según el perfil del usuario
                switch ($_SESSION['idPerfil']) {
                    case 1:
                        header('Location: ../Views/diagnostico.php');
                        break;
                    case 2:
                        header('Location: ../Views/tincion.php');
                        break;
                    case 3:
                        header('Location: ../Views/recepcion.php');
                        break;
                    case 4:
                        header('Location: ../Views/Registro.php');
                        break;
                    case 5:
                        header('Location: ../Views/mantenedorusuarios.php');
                        break;
                    case 6:
                        header('Location: ../Views/centro_medico.php');
                        break;
                    default:
                        header('Location: ../Views/login.php');
                        break;
                }
                exit();
            } else {
                $_SESSION['error_verificacion'] = true;
                header('Location: ../Views/verificacion.php');
                exit();
            }
        } else {
            // No se ha generado ningún código de verificación, redirigir al usuario a la página de verificación
            header('Location: ../Views/verificacion.php');
            exit();
        }
    } else {
        // No se proporcionó ningún código de verificación, redirigir al usuario a la página de verificación
        header('Location: ../Views/verificacion.php');
        exit();
    }
} else {
    // Si se intenta acceder al controlador directamente, redirigir al usuario a la página de verificación
    header('Location: ../Views/verificacion.php');
    exit();
}
?>
