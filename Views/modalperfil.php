<?php
$directorioActual = __DIR__;
$rutaperfil = dirname($directorioActual) . "/Controllers/perfilesController.php";
require_once $rutaperfil;
?>


<div class="modal fade" id="editar_Modal_<?php echo $idPerfil ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $modalTitle ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="mantenedorPerfiles.php">
                <div class="modal-body text-center">
                    <div class="row">
                        <input type="hidden" name="op" id="op" value='<?php echo $operacion ?>'>
                        <div class="col-9 mx-auto">
                            <input type="hidden" class="form-control" name="IDPerfil" value=<?php echo $idPerfil ?> readonly>
                            <label for="tipoPerfil"> Nombre Perfil</label>
                            <input required type="text" class="form-control" name="tipoPerfil" value="<?php echo $tipoPerfil ?>">
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="submit" name="GUARDAR" value="GUARDAR" class="btn" style="color:white; background-color:#023059">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>