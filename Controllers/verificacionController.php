<?php
session_start();

if (isset($_POST['op']) && $_POST['op'] == "VERIFICAR") {
    $codigoIngresado = $_POST['codigo'];
    $codigoGuardado = $_SESSION['codigo_verificacion'];

    if ($codigoIngresado == $codigoGuardado) {
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
    } else {
        $_SESSION['error_verificacion'] = true;
        header('Location: ../Views/verificacion.php');
    }
    exit();
}
?>
