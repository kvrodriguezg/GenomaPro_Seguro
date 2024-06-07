<?php
session_start();
function verificarAcceso($perfilesPermitidos) {
    if (!isset($_SESSION['idPerfil']) || $_SESSION['idPerfil'] !== $perfilesPermitidos) {
        error_log("Acceso no permitido para el perfil: " . $_SESSION['idPerfil']);
        header('Location: login.php');
        exit();
    }
}
function verificarCodigo()
{
    if (!isset($_SESSION['estado-verificacion']) || $_SESSION['estado-verificacion'] !== 1) {
        header('Location: ../index.php');
}
}
?>
