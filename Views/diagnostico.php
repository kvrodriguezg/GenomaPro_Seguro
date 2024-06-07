<?php
//$directorioActual = __DIR__;
//$rutaacceso = dirname($directorioActual) . "/Controllers/accesoController.php";
//require_once $rutaacceso;
//
//$directorioActual = __DIR__;
//$rutaexamenes = dirname($directorioActual) . "/Controllers/examenesController.php";
//require_once $rutaexamenes;
////
//$directorioActual = __DIR__;
//$rutahead = $directorioActual . "/Shared/head.php";
//require_once $rutahead;
require_once("../Controllers/examenesController.php");
include "../Views/Shared/head.php";
require_once('../Controllers/accesoController.php');

$perfilesPermitidos = 1;
verificarCodigo();
verificarAcceso($perfilesPermitidos);
?>

<link rel="stylesheet" href="../css/prueba.css">
<link rel="stylesheet" href="../css/nav.css">
<?php include "../Views/Shared/navDiagnostico.php" ?>

<body style="background-color: #E7E7E7; font-family: 'Montserrat';" class="text-center">
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
    <div style="height: 70px"></div>
    <br><br>
    <div style="width:100%; display:flex; justify-content:center;">
        <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;" class="text-center">
            <div style="position: absolute; z-index: 10;">
                <button type='button' style="color: #000000; position: absolute; left: 4px; top: 0;" class='btn center-block text-center btn-editar-usuario' data-bs-toggle='modal' data-user-id='0' data-bs-target='#editar_Modal'>

                </button>
            </div>
            <i class="fa-solid fa-stethoscope fa-2xl" style="color: #ffffff;"></i>
        </div>
    </div>


    <br><br><br>
    <section>
        <table id="pruebas4" class="tabla table">
            <thead>
                <tr>
                    <th>ID Examen</th>
                    <th>Nombre Paciente</th>
                    <th>Domicilio</th>
                    <th>Laboratorio</th>
                    <th>Examen</th>
                    <th>F. Toma de Muestra</th>
                    <th>Resultado</th>
                    <th>Estado</th>
                    <th>Cambiar Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($examenesDiagnostico as $row) { ?>
                    <tr class="table table-striped">
                        <form method="post" action="diagnostico.php">
                            <td><?php echo $row['IDExamen'] ?></td>
                            <td><?php echo $examen->obtenerNombrePaciente($row['RutPaciente']) ?></td>
                            <td><?php echo $examen->obtenerDomicilioPaciente($row['RutPaciente']) ?></td>
                            <td><?php echo $examen->obtenerCentroMedico($row['IDCentroSolicitante']) ?></td>
                            <td><?php echo $row['NombreExamen'] ?></td>
                            <td><?php echo $row['FechaTomaMuestra'] ?></td>


                            <td>
                                <select class="form-select" style="width: 150px" name="diagnostico" required>
                                    <?php
                                    $diagnosticos = $examen->obtenerListaDiagnosticos();

                                    while ($row1 = mysqli_fetch_array($diagnosticos)) {
                                        echo '<option value="' . $row1['Codigo'] . '">' . $row1['descripcion'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo $examen->obtenerEstadoActual($row['IDEstado']); ?></td>

                            <td>
                                <select class="form-select" style="width: 150px" name="estado" required>
                                    <?php
                                    $resultadoEstados = $examen->obtenerEstados('diagnostico');

                                    while ($row1 = mysqli_fetch_array($resultadoEstados)) {
                                        echo '<option value="' . $row1['IDEstado'] . '">' . $row1['NombreEstado'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <!-- <a href="generar_pdf.php" class="btn w-100 m-1 btn-danger" >Ver PDF</a>  -->
                                <input type="hidden" name="idExamen" value=<?php echo $row['IDExamen'] ?>>
                                <button name="actualizarEstadoDiagnostico" type="submit" style="border:none;"><i class="fa-solid fa-file-import fa-2xl" style="color: #023059;"></i></button>
                            </td>
                        </form>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
    <?php include "../views/Shared/scripts.php" ?>
    <script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../js/data3.js"></script>
</body>


</html>