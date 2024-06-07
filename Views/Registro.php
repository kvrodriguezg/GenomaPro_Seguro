<?php
$directorioActual = __DIR__;
$rutaacceso = dirname($directorioActual) . "/Controllers/accesoController.php";
require_once $rutaacceso;

$directorioActual = __DIR__;
$rutaexamenes = dirname($directorioActual) . "/Controllers/examenesController.php";
require_once $rutaexamenes;
//require_once("../Controllers/examenesController.php");
//require_once('../Controllers/accesoController.php');
$generaPdf = dirname($directorioActual) . "/Views/generar_pdf.php";
echo $generaPdf;
//require_once $generaPdf;

$perfilesPermitidos = (3);
verificarCodigo();
verificarAcceso($perfilesPermitidos);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Registro</title>
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


<?php
include("../Views/Shared/navRecepcion.php");
?>


<body class="text-center" style="background-color: #E7E7E7; font-family: 'Montserrat';">


    <div style="width:100%; display:flex; justify-content:center; margin-top:80px;">
        <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;" class="text-center">
            <div style="position: absolute; z-index: 10;">

            </div>
            <i class="fa-solid fa-2xl fa-file-prescription" style="color: #FFFFFF;"></i>
        </div>
    </div>
    <div class="table-container" style="margin-top:20px;">

        <div class="col-lg-11">
            <table id="pruebas4" class="table table-responsive">
                <thead style="background-color: #FFFFFF">
                    <tr>
                        <th>#</th>
                        <th>Nombre Paciente</th>
                        <th>Domicilio</th>
                        <th>Laboratorio</th>
                        <th>Examen</th>
                        <th>F. Toma de Muestra</th>
                        <th>F. Diagnóstico</th>
                        <th>Diagnóstico</th>
                        <th>Cod. Diagnóstico</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($examenes as $row) { ?>
                        <tr class="table table-striped">
                            <form method="post" action="Registro.php">
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
                                    <button type="button" class="btn btn-outline-danger" <?php if ($row['IDEstado'] == 3) { ?> onclick="window.open('generar_pdf.php?id=<?php echo $row['IDExamen']; ?>', '_blank');">
                                        <img src="../img/pdf.png" alt="Icono PDF">
                                    <?php } else { ?>
                                        ><img src="../img/pdf.png" alt="Icono PDF">
                                    <?php
                                                                                            }
                                    ?>
                                    </button>

                                </td>
                                <td>
                                    <!-- <a href="generar_pdf.php" class="btn w-100 m-1 btn-danger" >Ver PDF</a>  -->
                                    <input type="hidden" name="idExamen" value=<?php echo $row['IDExamen'] ?>>
                                    <button name="eliminarRegistro" type="submit" class="btn w-100 m-1"><i class="fa-solid fa-2xl fa-trash" style="color: #023059;"></i></button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../datatables/datatables.min.js"></script>

    <!-- para usar botones en datatables JS -->
    <script src="../datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="../datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="../datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

    <!-- código JS propìo-->
    <script type="text/javascript" src="../js/data3.js"></script>
</body>

</html>