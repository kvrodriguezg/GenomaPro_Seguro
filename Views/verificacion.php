<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
if (isset($_SESSION['error_verificacion']) && $_SESSION['error_verificacion'] === true) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Código de verificación incorrecto. Por favor, inténtelo de nuevo.",
                confirmButtonColor: "#023059"
            });
    });
    </script>';
    unset($_SESSION['error_verificacion']);
}
?>
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
    <title>Iniciar Sesión</title>
</head>
<div class="container rounded-3" style="display: flex; flex-direction: column; justify-content: center; height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="../Controllers/verificacionController.php" class="form">

                        <img class="img-login mx-auto d-block" src="../img/1.png" alt="" width="250">
                        <h1 style="text-align: center;">Verificación en dos pasos</h1><br>

                        <div class="pl-6 px-5">
                            <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <img src="../img/user2.png" width="20" height="20">
                                    </span>
                                <input type="text" class="form-control" name="codigo" placeholder="Ingrese su codigo">
                            </div>
                            <input type="hidden" name="op" value="VERIFICAR"><br>
                            <input type="submit" class="btn btn-primary mx-auto d-block" name="btnvalidar"
                                   value="Ingresar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>