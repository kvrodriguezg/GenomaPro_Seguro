<?php
$directorioActual = __DIR__;
$rutacentro = dirname($directorioActual) . "/Controllers/centrosmedicosController.php";
require_once $rutacentro;
?>

<div class="modal fade" id="editar_Modal_<?php echo $IDCentroMedico ?>" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="mantenedorlaboratorios.php">
                <div class="modal-body text-center">
                    <div class="row">
                        <input type="hidden" name="operacion" value='<?php echo $operacion ?>'>
                        <div class="col-9 mx-auto">
                            <input type="hidden" class="form-control" name="IDCentroMedico"
                                   value=<?php echo $IDCentroMedico ?> readonly>
                            <label for="nombreCentro"> Nombre Centro</label>
                            <input required type="text" class="form-control" name="nombreCentro"
                                   value="<?php echo $nombreCentro ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-9 mx-auto">
                            <label for="codigo">Código</label><br>
                            <input required type="text" class="form-control" name="codigo"
                                   value="<?php echo $codigo ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="modal-footer">
                                <button type="submit" name="enviar" class="btn"
                                        style="color:white; background-color:#023059"><?php echo $boton ?></button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>