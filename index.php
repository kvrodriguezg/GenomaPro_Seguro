<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$directorioActual = __DIR__;
$rutaacceso = $directorioActual . "/Controllers/indexController.php";
require_once $rutaacceso;
//require_once("Controllers/indexController.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="./css/estiloindex.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Pagina De Inicio</title>
</head>

<body>
    <div class="contenedor">
        <div class="container_logo">
            <img src="./img/4.png" alt="Logo_GENOMA" class="logo">
        </div>

        <button class="btn_login" role="link" onclick="window.location.href = 'Views/login.php'">
            Inicio de Sesión
        </button>
        <?php
        if (!$validacionExistencia) {
            echo '
                    <form method="post" action="index.php">
                        <input type="hidden" name="crearTabla" value="crear">
                        <button style="width:100px; height: 20px; font-size:12px; border-radius:10px; border:none;">Crear Tabla</button>
                    </form>';
        } ?>
        <div class="container">
            <nav class="nav">
                <ul class="nav">

                </ul>
            </nav>

        </div>
        <main class="principal">
            <div class="info_genoma">
                <p class="text_info">
                    En el GenomaPro, nos especializamos en el análisis de
                    muestras de ADN para la realización de pruebas de
                    paternidad. Trabajamos en estrecha colaboración con
                    centros médicos y clínicas que nos envían muestras
                    biológicas para su análisis. Utilizando técnicas
                    avanzadas de análisis de ADN, llevamos a cabo pruebas de
                    paternidad con resultados altamente precisos y confiables.
                </p>
            </div>

            <div class="info_test">
                <span>Pruebas de Paternidad</span>
                <span>Pruebas de Maternidad y Otros Vínculos Familiares</span>
                <span>Pruebas Prenatales No Invasivas</span>
            </div>
        </main>

    </div>
    <style>
        .icono {
            color: #f1683a;
        }
    </style>
</body>

</html>