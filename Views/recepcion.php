<?php
$directorioActual = __DIR__;
$rutaacceso = dirname($directorioActual) . "/Controllers/accesoController.php";
require_once $rutaacceso;
//$directorioActual = __DIR__;
$rutaexamenes = dirname($directorioActual) . "/Controllers/examenesController.php";
require_once $rutaexamenes;

//require_once("../Controllers/examenesController.php");
//require_once('../Controllers/accesoController.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$perfilesPermitidos = 3;
verificarCodigo();
verificarAcceso($perfilesPermitidos);
?>
<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<title>Recepción</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<!-- CSS personalizado -->
<link rel="stylesheet" href="../css/prueba.css">
<!--datables CSS básico-->
<link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css" />
<!--datables estilo bootstrap 4 CSS-->
<link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<!--font awesome con CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="../css/nav.css">
</head>

<body style="background-color: #E7E7E7; font-family: 'Montserrat';" class="text-center">
    <header class="navbar navbar-light fixed-top" style="background-color: #FFFFFF;">
        <?php
        include("../Views/Shared/navRecepcion.php");
        ?>
    </header>
    <br><br><br><br><br>
    <div>
        <div>
        </div>

    </div>
    <br>

    <div style="width:100%; display:flex; justify-content:center;">
        <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;" class="text-center">
            <div style="position: absolute; z-index: 10;">
                <button type='button' style="color: #000000; position: absolute; left: 4px; top: 0;" class='btn center-block text-center btn-nuevo-examen' data-bs-toggle="modal" data-id=0 bs-target="#editar_Modal_0">
                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                </button>
            </div>
            <i class="fa-solid fa-clipboard fa-2xl" style="color: #ffffff;"></i>
        </div>
    </div>
    <style>
        .dt-buttons {
            float: left !important;
            text-align: left !important;
        }

        .dataTables_filter {
            float: right !important;
            text-align: right !important;
        }

        .tabla-recepcion thead th {
            background-color: #023E73;
            color: white;
            text-decoration: none;
            font-weight: lighter;
            text-align: center;

        }

        .tabla-recepcion td {
            padding: 10px;
            background-color: #FFFFFF;
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
    <div class="row" style="margin:0 10px 0 10px;">
        <div class="col-m-12">
            <table id="pruebas4" class="tabla-recepcion">
                <thead class="bg-primary" style="color:white;">
                    <tr>
                        <th>ID Examen</th>
                        <th>Nombre Paciente</th>
                        <th>Domicilio</th>
                        <th>Laboratorio</th>
                        <th>Examen</th>
                        <th>F. Toma de Muestra</th>
                        <th>F. Diagnóstico</th>
                        <th>Diagnóstico</th>
                        <th>Cod. Diagnóstico</th>
                        <th>Estado</th>
                        <th>Cambiar Estado</th>
                        <th>PDF</th>
                        <TH>Acciones</TH>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($examenes as $row) { ?>
                        <tr class=>
                            <form method="post" action="recepcion.php">
                                <td><?php echo $row['IDExamen'] ?></td>
                                <td><?php echo $examen->obtenerNombrePaciente($row['RutPaciente']) ?></td>
                                <td><?php echo $examen->obtenerDomicilioPaciente($row['RutPaciente']) ?></td>
                                <td><?php echo $examen->obtenerCentroMedico($row['IDCentroSolicitante']) ?></td>
                                <td><?php echo $row['NombreExamen'] ?></td>
                                <td><?php echo $row['FechaTomaMuestra'] ?></td>
                                <td><?php echo $row['Fechadiagnostico'] ?></td>
                                <td><?php echo $examen->obtenerDiagnostico($row['CodigoDiagnosticos']); ?></td>
                                <td><?php echo $row['CodigoDiagnosticos']; ?></td>
                                <td><?php echo $examen->obtenerEstadoActual($row['IDEstado']); ?></td>

                                <td>
                                    <select class="form-select" style="width: 150px" name="estado" required>
                                        <?php
                                        $resultadoEstadosRecepcion = $examen->obtenerEstados('recepcion');
                                        if ($resultadoEstadosRecepcion) {
                                            while ($row1 = mysqli_fetch_array($resultadoEstadosRecepcion)) {
                                                echo '<option value="' . $row1['IDEstado'] . '">' . $row1['NombreEstado'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger" <?php if ($row['IDEstado'] == 3) { ?> onclick="window.open('generar_pdf.php?id=<?php echo $row['IDExamen']; ?>', '_blank');">
                                        <img src="../img/pdf.png" alt="Icono PDF">
                                    <?php } else { ?>
                                        ><img src="../img/pdf.png" alt="Icono PDF">
                                    <?php
                                                                                            }
                                    ?>
                                    </button>
                                </td>
                                <td style="display: flex;">
                                    <!-- <a href="generar_pdf.php" class="btn w-100 m-1 btn-danger" >Ver PDF</a>  -->
                                    <input type="hidden" name="idExamen" value=<?php echo $row['IDExamen'] ?>>
                                    <button name="actualizarEstado" type="submit" style="border:none;background-color:white; height:70px; width:71px;"><i class="fa-solid fa-file-import fa-2xl" style="color: #023059;"></i></button>
                                    <button name="eliminarRegistro" type="submit" value="Eliminar" style="border:none; background-color:white;"><i class="fa-solid fa-2xl fa-trash" style="color:#023059;"></i></button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>

<script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
<script src="../jquery/jquery-3.3.1.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

<!-- datatables JS -->
<script type="text/javascript" src="../datatables/datatables.min.js"></script>
<!-- código JS propìo-->
<script type="text/javascript" src="../js/data3.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-nuevo-examen').click(function() {
            $.ajax({
                type: 'POST',
                url: 'modalIngresoExamen.php',
                success: function(response) {
                    $('body').append(response);
                    $('#editar_Modal_0').modal('show');
                }
            });
        });
    });
</script>