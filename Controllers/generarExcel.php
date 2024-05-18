<?php
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename = registro.xls");
//$directorioActual = __DIR__;
//$usuarioModel = dirname($directorioActual) . "/Models/centromedicoModel.php";
//require_once $usuarioModel;
include("../Models/centromedicoModel.php");

$obj=new centromedico();


$listado = $obj->verCentros();

?>

<section style="margin: 10px;">
    <table id="tableUsers" class="tabla table">
    <style>
        .tabla {
            width: 100%;
        }
        </style>
        <thead>
        <tr>
            <th>ID </th>
            <th>Nombre Laboratorio </th>
            <th>Código  </th>
        </tr>
        </thead>
        <tbody>
        <tr >                <?php
                foreach ($listado as $registro) {
                    ?>
        <td>
                            <?php echo $registro['IDCentroMedico']; ?>
                        </td>
                        <td>
                            <?php echo $registro['NombreCentro']; ?>
                        </td>
                        <td>
                            <?php echo $registro['codigo']; ?>
                        </td>
                    </tr>
                    <?php
                }

                ?>
        </tbody>
    </table>
</section>