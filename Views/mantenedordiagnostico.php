<?php
//$directorioActual = __DIR__;
//$ruta = dirname($directorioActual) . "/Models/conex.php";
//require_once $ruta;
//
//$rutaacceso = dirname($directorioActual) . "/Controllers/accesoController.php";
//require_once $rutaacceso;

include_once("../Controllers/diagnosticoController.php");
require_once('../Controllers/accesoController.php');
$perfilesPermitidos = 5;
verificarCodigo();
verificarAcceso($perfilesPermitidos); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/tablas.css">
    <title>Diagnósticos</title>
</head>
<header class="navbar navbar-light fixed-top" style="background-color: #FFFFFF;">
    <?php
    include_once("../Views/Shared/nav.php");
    ?>
</header>

<body class="text-center" style="background-color: #E7E7E7; font-family: 'Montserrat';">
    <br><br><br><br><br>
    <div style="width:100%; display:flex; justify-content:center;">
        <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;" class="text-center">
            <div style="position: absolute; z-index: 10;">
                <button type='button' style="color: #000000; position: absolute; left: 4px; top: 0;" class='btn center-block text-center btn-editar-diagnostico' data-bs-toggle='modal' data-cod-diag=0 data-bs-target='#editar_Modal_0'>
                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                </button>
            </div>
            <i class="fa-solid fa-2xl fa-microscope" style="color: #ffffff;"></i>
        </div>
    </div>
    <br><br><br>
    <div>

        <div class="table-container">
            <div class="col-lg-11">
                <table id="pruebas4" class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center; background-color: #FFFFFF">
                        <?php while ($fila = mysqli_fetch_assoc($diagnosticos)) : ?>

                            <tr class="table">
                                <td><?php echo $fila['Codigo'] ?></td>
                                <td><?php echo $fila['descripcion'] ?></td>
                                <td>
                                    <div>
                                        <button style="margin-top: 10px;" type='button' class='btn center-block btn-editar-diagnostico' data-bs-toggle='modal' data-cod-diag=<?php echo $fila['Codigo']; ?> bs-target='#editar_Modal_' <?php echo $fila['Codigo'] ?>>
                                            <i class="fa-solid fa-2xl fa-pen-to-square" style="color: #023059;"></i></button>
                                    </div>

                                </td>
                                <td>
                                    <form method="POST" id="eliminarForm" action="mantenedordiagnostico.php" class="eliminarForm">
                                        <input type="hidden" name="operacion" id="operacion" value="eliminar">
                                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $fila['Codigo']; ?>">
                                        <button style="margin-top: 10px;" type="submit" class="btn"><i class="fa-solid fa-2xl fa-trash" style="color: #023059;"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </section>
            </div>



            <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script type="text/javascript" src="../datatables/datatables.min.js"></script>
            <script type="text/javascript" src="../js/data3.js"></script>

            <script>
                $(document).ready(function() {
                    $('.btn-editar-diagnostico').click(function() {
                        var codigo = $(this).data('cod-diag');
                        $.ajax({
                            type: 'POST',
                            url: 'modalDiagnostico.php',
                            data: {
                                codigo: codigo,
                            },
                            success: function(response) {
                                $('body').append(response);
                                $('#editar_Modal_' + codigo).modal('show');
                            }
                        });
                    });
                });
            </script>
            <script>
                function confirmarYEliminar(codigo) {
                    var confirmacion = confirm("¿Estás seguro de que deseas eliminar este diagnóstico?");
                    if (confirmacion) {
                        var opField = document.getElementById('operacion');
                        opField.value = "eliminar";
                        var codigoEliminar = document.getElementById('codigo');
                        codigoEliminar.value = codigo;
                        console.log("Valor del campo op:", opField.value);
                        document.getElementById('eliminarForm').submit();
                    }
                }
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
</body>

</html>