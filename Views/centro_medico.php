<?php
$directorioActual = __DIR__;
$rutaacceso = dirname($directorioActual) . "../Controllers/accesoController.php";
require_once $rutaacceso;
$perfilesPermitidos = 6;
verificarCodigo();
verificarAcceso($perfilesPermitidos);
$rutacentro = dirname($directorioActual) . "../Controllers/centroController.php";
require_once $rutacentro;
//require_once("../Controllers/centroController.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#"/>
    <title>Centro Médico</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../css/prueba.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <!--font awesome con CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/nav.css">

    <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #E7E7E7; font-family: 'Montserrat';">

<
<?php
include("../Views/Shared/navcentro.php");
?>

<div style="width:100%; display:flex; justify-content:center; margin-top:80px;">
    <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;"
         class="text-center">
        <div style="position: absolute; z-index: 10;">
            <button type='button' style="color: #000000; position: absolute; left: 4px; top: 0;"
                    class="btn center-block  btn-editar-centro" data-bs-toggle="modal" data-id=0
                    bs-target="#editar_Modal_0">
            </button>
        </div>
        <i class="fa-regular fa-2xl fa-hospital" style="color: #ffffff;"></i>
    </div>

</div>
<div style="width:100%; display:flex; justify-content:center; margin-top:20px;">
    <h1 style="font-weight: bolder;"><?php echo "$nombreCentro"; ?><h1>
</div>

<div style="height: 20px; margin:0 10px 0 10px;">
    <div class="row">
        <div class="col-lg-12">
            <table id="pruebas" class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rut</th>
                    <th>Fecha de Toma</th>
                    <th>Fecha de orden</th>
                    <th>Nombre de Ex&aacute;men</th>
                    <th>Estado</th>
                    <th>Ver Diagn&oacute;stico</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($listExamenes as $list) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $list['NombrePaciente']; ?>
                        </td>
                        <td>
                            <?php echo $list['NombreExamen']; ?>
                        </td>
                        <td>
                            <?php echo $list['RutPaciente']; ?>
                        </td>
                        <td>
                            <?php echo $list['FechaTomaMuestra']; ?>
                        </td>
                        <td>
                            <?php echo $list['FechaRecepcion']; ?>
                        </td>
                        <td>
                            <?php echo $list['NombreEstado']; ?>
                        </td>
                        <td style="text-align: center;">
                            <button type="button" class="btn btn-outline-danger"
                                <?php if ($list['IDEstado'] == 3) { ?>
                                    onclick="window.open('generar_pdf.php?id=<?php echo $list['IDExamen']; ?>', '_blank');">
                                <img src="../img/pdf.png" alt="Icono PDF">
                                <?php } else { ?>
                                    ><img src="../img/pdf.png" alt="Icono PDF">
                                    <?php
                                }
                                ?>
                            </button>
                        </td>

                    </tr>
                <?php }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
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
<script type="text/javascript" src="../js/data.js"></script>

</body>
<style>
    .table thead th {
        background-color: #023E73;
        color: white;
        text-decoration: none;
        font-weight: lighter;
    }

    .table td {
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
</html>