<?php

$directorioActual = __DIR__;
$rutausuarios = dirname($directorioActual) . "/Controllers/usuarioscontroller.php";
require_once $rutausuarios;
$rutaaccesso = dirname($directorioActual) . "/Controllers/accesoController.php";
require_once $rutaaccesso;

$objusuario=new usuario();
$listusuarios = $objusuario->verUsuarios();
$perfilesPermitidos = 5;
verificarAcceso($perfilesPermitidos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/prueba.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../css/nav.css">
    <title>Document</title>
</head>
<?php
include("../Views/Shared/nav.php");
?>
<br><br><br><br><br>


<body class="text-center" style="background-color: #E7E7E7; font-family: 'Montserrat';">
<div style="width:100%; display:flex; justify-content:center;">
    <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;"
         class="text-center">
        <div style="position: absolute; z-index: 10;">
            <button type='button' style="color: #000000; position: absolute; left: 4px; top: 0;"
                    class='btn center-block text-center btn-editar-usuario' data-bs-toggle='modal' data-user-id='0'
                    data-bs-target='#editar_Modal'>
                <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
            </button>
        </div>
        <i class="fa-regular fa-user fa-2xl" style="color: #FFFFFF;"></i>
    </div>
</div>

<!-- <h1 style="padding-top:20px; color:#000000">Usuarios</h1><br> -->


<br><br><br>
<style>
    .table thead th {
        background-color: #023E73;
        color: white;
        text-decoration: none;
        font-weight: lighter;
        text-align: center;
    }

    .col-clave {
        max-width: 100px;
        overflow: hidden;
        /* Oculta el texto que excede el ancho máximo */
        text-overflow: ellipsis;
        /* Agrega puntos suspensivos (...) al final del texto truncado */
        white-space: nowrap;
        /* Evita que el texto se divida en varias líneas */
    }

    .table-container {
        display: flex;
        justify-content: center;
    }
</style>
<div>

    <div class="table-container">
        <div class="col-lg-11">
            <table id="tableUsers" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Rut</th>
                    <th class="clave">Clave</th>
                    <th>Perfil</th>
                    <th>Centro Medico</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody style="text-align:center; background-color: #FFFFFF">
                <?php
                $tempUsuarios = array();
                foreach ($listusuarios as $usu) {
                    $tempUsuarios[] = $usu;
                    ?>
                    <tr>
                        <td>
                            <?php echo $usu['IDUsuario']; ?>
                        </td>
                        <td>
                            <?php echo $usu['usuario']; ?>
                        </td>
                        <td>
                            <?php echo $usu['Nombre']; ?>
                        </td>
                        <td>
                            <?php echo $usu['Correo']; ?>
                        </td>
                        <td>
                            <?php echo $usu['Rut']; ?>
                        </td>
                        <td class="col-clave">
                            <?php echo $usu['Clave']; ?>
                        </td>
                        <td>
                            <?php
                            $perfil = $objusuario->buscarPerfilId($usu['IDPerfil']);
                            echo $perfil['TipoPerfil'];
                            ?>
                        </td>
                        <td>
                            <?php $centro = $objusuario->buscarcentroID($usu['IDCentroMedico']);
                            echo $centro['NombreCentro'] ?? '';
                            ?>
                        </td>
                        <td>
                            <button type='button' style="margin-top: 10px;"
                                    class='btn w-100 center-block btn-editar-usuario' data-bs-toggle='modal'
                                    data-user-id=<?php echo $usu['IDUsuario']; ?> data-bs-target='#editar_Modal_' <?php echo $usu['IDUsuario'] ?>>
                                <i class="fa-solid fa-2xl fa-pen-to-square" style="color: #023059;"></i></button>
                        </td>
                        <td class="text-center">
                            <form method="POST" action="" id="eliminarForm_<?php echo $usu['IDUsuario']; ?>"
                                  class="eliminarform">
                                <input type="hidden" name="op" id="op" value="eliminar">
                                <input type="hidden" name="IDUsuarioEliminar" value=<?php echo $usu['IDUsuario']; ?>>
                                <button type="submit" style="margin-top: 10px;" class="btn"><i
                                            class="fa-solid fa-2xl fa-trash" style="color: #023059;"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
        </div>

        <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {
                $('.btn-editar-usuario').click(function () {
                    var userId = $(this).data('user-id');
                    $.ajax({
                        type: 'POST',
                        url: 'modalUsuario.php',
                        data: {
                            userId: userId
                        },
                        success: function (response) {
                            $('body').append(response);
                            $('#editar_Modal_' + userId).modal('show'); // Abre el modal con el ID único
                        }
                    });
                });
            });
        </script>
        <script>
            $('.eliminarform').submit(function (e) {
                e.preventDefault();

                Swal.fire({
                    title: "¿Está seguro que desea eliminarlo?",
                    showDenyButton: true,
                    confirmButtonText: "SI",
                    denyButtonText: "NO",
                    confirmButtonColor: '#023059'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario hace clic en "Si"
                        this.submit();
                    } else if (result.isDenied) {
                        // Si el usuario hace clic en "No"
                        Swal.fire({
                            title: "No se eliminará.",
                            icon: "info",
                            confirmButtonColor: '#023059'
                        });
                    }
                });
            })
        </script>
</body>

</html>