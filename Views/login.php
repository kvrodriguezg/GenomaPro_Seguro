<?php

//$ruta = dirname($directorioActual) . "/Controllers/loginController.php";
//require_once $ruta;
$op = "";
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $op = $_POST['op'] ?? '';

    if ($op == "LOGIN") {
        require_once("../Controllers/loginController.php");
    }
}

//header("Content-Security-Policy: default-src 'self' https://www.google.com; script-src 'self' https://www.google.com/recaptcha/ https://www.gstatic.com/ 'unsafe-inline' 'unsafe-eval'; style-src 'self' https://fonts.googleapis.com https://cdn.jsdelivr.net 'unsafe-inline'; font-src 'self' https://fonts.gstatic.com https://cdn.jsdelivr.net data:; frame-src 'self' https://www.google.com;");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Iniciar Sesión</title>
</head>

<body>
<div class="container rounded-3"
     style="display: flex; flex-direction: column; justify-content: center; overflow:hidden; ">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="login.php" class="form" onsubmit="return validarFormulario()">

                        <img class="img-login mx-auto d-block" src="../img/1.png" alt="" width="250">
                        <h1 style="text-align: center;">Iniciar Sesión</h1><br>
                        <?php
                        if (!empty($error)) {
                            echo
                                '<script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: "' . $error . '",
                                                confirmButtonColor: "#023059"
                                            });
                                    });
                                </script>';
                        }
                        ?>

                        <div class="pl-6 px-5">
                            <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <img src="../img/user2.png" width="20" height="20">
                                    </span>
                                <input type="text" class="form-control" name="usuario" placeholder="Ingrese su usuario">
                            </div>
                            <br>
                            <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <img src="../img/padlock.png" width="20" height="20">
                                    </span>
                                <input type="password" class="form-control" name="clave" placeholder="Ingrese su clave">
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LdH4M4pAAAAACFx6bwJwmKLPTpWZr6tLwf5cinF"></div>
                            <input type="hidden" name="op" value="LOGIN"><br>
                            <input type="submit" class="btn btn-primary mx-auto d-block" name="btnlogin"
                                   value="Ingresar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validarFormulario() {

        var respuesta = grecaptcha.getResponse();
        if (respuesta.length == 0) {

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Por favor, verifica que no eres un robot.",
                confirmButtonColor: "#023059"
            });
            return false;
        }
        return true;
    }
</script>
</html>>