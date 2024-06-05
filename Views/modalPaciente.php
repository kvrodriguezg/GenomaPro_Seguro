<?php
$directorioActual = __DIR__;
$rutaestado = dirname($directorioActual) . "/Controllers/pacientesController.php";
require_once $rutaestado;
?>
<div class="modal fade" id="editar_Modal_<?php echo $PacienteId ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $modalTitle ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" class="form" action="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="Rut" style="text-align: center;">RUT:</label>
                            <input type="text"  <?php echo $readonly ?> class="form-control" name="Rut" value="<?php echo $rut; ?>"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style="text-align: center;">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>"><br>
                            <input type="hidden" name="PacienteId" value="<?php echo $PacienteId; ?>">
                            <input type="hidden" name="op" value="<?php echo $op; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style="text-align: center;">Domicilio:</label>
                            <input type="text" class="form-control" name="domicilio" value="<?php echo $domicilio; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="submit" name="ModificarRegistro" class="btn" style="color:white; background-color:#023059">Enviar
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>