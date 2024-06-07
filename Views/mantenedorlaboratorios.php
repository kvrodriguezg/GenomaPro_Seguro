<?php
$directorioActual = __DIR__;
$rutacentro = dirname($directorioActual) . "/Controllers/centrosmedicosController.php";
$rutaacceso = dirname($directorioActual) . "/Controllers/accesoController.php";
require_once $rutacentro;
require_once $rutaacceso;

//require_once('../Controllers/accesoController.php');
//require_once('../Controllers/centrosmedicosController.php');
$perfilesPermitidos = 5;
verificarCodigo();
verificarAcceso($perfilesPermitidos);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../css/registro.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/nav.css">
    <title>Document</title>
</head>


<header class="navbar navbar-light fixed-top" style="background-color: #FFFFFF;">
    <?php
    include("../Views/Shared/nav.php");
    ?>
</header>
<br><br><br><br><br>

<style>
    .dt-buttons {
        float: left !important;
        text-align: left !important;
    }

    .dataTables_filter {
        float: right !important;
        text-align: right !important;
    }

    .table thead th {
        background-color: #023E73;
        color: white;
        text-decoration: none;
        font-weight: lighter;
        text-align: center;
    }

    .table-container {
        display: flex;
        justify-content: center;
    }
</style>

<style>
    .center-button {
        text-align: center;
    }
</style>

<body class="text-center" style="background-color: #E7E7E7; font-family: 'Montserrat';">
    <div style="width:100%; display:flex; justify-content:center;">
        <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;" class="text-center">
            <div style="position: absolute; z-index: 10;">
                <button type='button' style="color: #000000; position: absolute; left: 4px; top: 0;" class="btn center-block  btn-editar-centro" data-bs-toggle="modal" data-id=0 bs-target="#editar_Modal_0">
                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                </button>
            </div>
            <i class="fa-regular fa-2xl fa-hospital" style="color: #ffffff;"></i>
        </div>
    </div>
    <br><br><br>

    <div class="table-container">
        <div class="col-lg-11">
            <table id="pruebas4" class="table table-responsive">
                <style>
                    .tabla {
                        width: 100%;
                    }
                </style>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="text-align:center; background-color: #FFFFFF">
                    <?php
                    foreach ($listCentros as $registro) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $registro['IDCentroMedico']; ?>
                            </td>
                            <td>
                                <?php echo $registro['NombreCentro']; ?>
                            </td>
                            <td>
                                <?php echo $registro['codigo']; ?>
                            </td>
                            <td>
                                <div>
                                    <button style="margin-top: 10px;" type='button' class='btn center-block btn-editar-centro' data-bs-toggle='modal' data-id=<?php echo $registro['IDCentroMedico']; ?> data-bs-target='#editar_Modal_' <?php echo $registro['IDCentroMedico'] ?>>
                                        <i class="fa-solid fa-2xl fa-pen-to-square" style="color: #023059;"></i></button>
                                </div>
                            </td>
                            <td class="text-center">
                                <form method="POST" action="" id="eliminarCentroForm" class="eliminarForm">
                                    <input type="hidden" name="op" value="ELIMINAR">
                                    <input type="hidden" name="IDCentroMedico" value="<?php echo $registro['IDCentroMedico']; ?>">
                                    <button style="margin-top: 10px;" type="submit" class="btn center-block"><i class="fa-solid fa-2xl fa-trash" style="color: #023059;"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            </section>


            <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script type="text/javascript" src="../datatables/datatables.min.js"></script>
            <script type="text/javascript" src="../js/data3.js"></script>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('.btn-editar-centro').click(function() {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'modalCentroMedico.php',
                data: {
                    id: id,
                },
                success: function(response) {
                    $('body').append(response);
                    $('#editar_Modal_' + id).modal('show');
                }
            });
        });
    });
</script>

<script>
    $('.eliminarform').submit(function(e) {
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