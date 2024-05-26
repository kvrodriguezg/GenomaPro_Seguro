<?php
$op = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoPerfil = $_POST['tipoPerfil'] ?? '';
    $op = $_POST['op'] ?? '';


    if ($op == "GUARDAR") {
        //$directorioActual = __DIR__;
        //$rutaperfiles = dirname($directorioActual) . "/Controllers/perfilesController.php";
        //require_once $rutaperfiles;
        require_once("../Controllers/perfilesController.php");
    }
}
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

    <title>Mantenedor</title>
</head>

<body>
<header class="navbar navbar-light fixed-top" style="background-color: #9CD0FE;">
    <?php
    include("menuadministrador.php");
    ?>
</header>
<br><br>
<?php

?>

<form method="POST" class="form" action="crearperfil.php" style="padding: 100px 300px 0 300px;">
    <h2 style="text-align: center;">Crear Perfil</h2><br>
    <br>
    <div class="row">
        <div class="col">
            <label for="tipoPerfil">Nombre perfil:</label> <br><br>
            <input type="text" name="tipoPerfil" placeholder="tipoPerfil">
            <input type="hidden" name="op" value="GUARDAR">
        </div>
    </div>

    <br><br><br>
    <input class="btn w-100 m-1 btn-primary btn-sm" name="crearperfilbtn" type="submit" value="INSERTAR"/>
</form>
<script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>

</html>