<?php
$directorioActual = __DIR__;
$rutaestado = dirname($directorioActual) . "/Controllers/EstadoController.php";
require_once $rutaestado;
$IDEstado = $_POST['estadoID'];
?>
<div class="modal fade" id="editar_Modal<?php echo $IDEstado ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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
                            <label for="AgregaNEstado" style="text-align: center;">Estado:</label>
                            <input type="text" class="form-control" name="AgregaNEstado"
                                   value="<?php echo $AgregaNEstado; ?>"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style="text-align: center;">Perfil:</label>
                            <select class="form-select" name="IDPerfil" required>
                                <?php
                                foreach ($DetallePerfiles as $opcPerfil) {
                                    $idPerfil = $opcPerfil['IDPerfil'];
                                    $tipoPerfil = $opcPerfil['TipoPerfil'];
                                    $selected = ($idPerfil == $perfilSelecionado) ? 'selected' : '';

                                    echo "<option value='$idPerfil' $selected>$tipoPerfil</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="IDEstado" value="<?php echo $IDEstado; ?>">
                        <input type="hidden" name="op" value="<?php echo $op; ?>">
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="submit" name="ModificarRegistro" class="btn"
                                style="color:white; background-color:#023059">Enviar
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>