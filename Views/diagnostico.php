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
verificarAcceso($perfilesPermitidos);
?>

<link rel="stylesheet" href="../css/prueba.css">
<link rel="stylesheet" href="../css/nav.css">
<?php include "../Views/Shared/navDiagnostico.php" ?>
<body style="background-color: #E7E7E7; font-family: 'Montserrat';">
<div style="height: 70px"></div>
<br><br>
<div style="width:100%; display:flex; justify-content:center;">
    <div style="width: 80px; height: 80px; border-radius: 100%; background-color: #023E73; display: flex; justify-content: center; align-items: center; position: relative;"
         class="text-center">
        <div style="position: absolute; z-index: 10;">
            <button type='button' style="color: #000000; position: absolute; left: 4px; top: 0;"
                    class='btn center-block text-center btn-editar-usuario' data-bs-toggle='modal' data-user-id='0'
                    data-bs-target='#editar_Modal'>

            </button>
        </div>
        <i class="fa-solid fa-stethoscope fa-2xl" style="color: #ffffff;"></i>
    </div>
</div>


<br><br><br>
<section>
    <table id="tableUsers" class="tabla table">
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
        <?php while ($row = mysqli_fetch_array($examenesDiagnostico)) { ?>
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
                        <button name="actualizarEstadoDiagnostico" type="submit" style="border:none;"><i
                                    class="fa-solid fa-file-import fa-2xl" style="color: #023059;"></i></button>
                    </td>
                </form>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>
</body>
<?php include "../views/Shared/scripts.php" ?>
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