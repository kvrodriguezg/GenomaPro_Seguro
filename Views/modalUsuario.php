<?php

$directorioActual = __DIR__;
$rutausuarios = dirname($directorioActual) . "/Controllers/usuarioscontroller.php";
require_once $rutausuarios;
$IDUsuario = $_POST['userId'];
$objusuario = new usuario();
$row = $objusuario->buscarUsuarioporID($IDUsuario);
$perfiles = array();
$centros = array();
$perfiles = $objusuario->buscarPerfiles();
$centros = $objusuario->buscarCentros()
?>
	<script xmlns="">
        function agregarGuion() {
            var rutInput = document.getElementById('rut');
            var valorRut = rutInput.value.replace(/[^\dKk]/g, '');

            if (valorRut.length <= 10) {
                rutInput.value = formatearRut(valorRut);
            }
        }

        function formatearRut(rut) {
            if (rut.length > 1) {
                return rut.slice(0, -1) + '-' + rut.slice(-1);
            }
            return rut;
        }
    </script>

<?php if ($IDUsuario > 0) { ?>
    <div class="modal fade" id="editar_Modal_<?php echo $row['IDUsuario']; ?>" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="mantenedorusuarios.php">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="nombre">Nombre Completo:</label>
                                <input required type="text" class="form-control" name="nombre"
                                       value="<?php echo $row['Nombre']; ?>">

                            </div>
                            <div class="col">
                                <label for="rut">Rut:</label>
                                <input readonly required type="text" class="form-control" name="rut" maxlength="10"
                                       oninput="agregarGuion()" value="<?php echo $row['Rut']; ?>">


                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="usuario">Usuario:</label>
                                <input required type="text" class="form-control" name="usuario"
                                       value="<?php echo $row['usuario']; ?>">
                            </div>
                            <div class="col">
                                <label for="clave">Clave:</label>
                                <input required type="password" class="form-control" name="clave"
                                       value="<?php echo $row['Clave']; ?>">
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="correo">Correo:</label>
                                <input required type="email" class="form-control" name="correo"
                                       value="<?php echo $row['Correo']; ?>">
                            </div>

                        </div>

                        <br>
                        <?php

                        $perfilUsuario = $objusuario->buscarPerfilId($row['IDPerfil']);
                        $centroUsuario = $objusuario->buscarcentroID($row['IDCentroMedico']); ?>

                        <div class="row">
                            <div class="col">
                                <label for="perfil">Perfil:</label>
                                <select required class="form-select" style="width: 100%"
                                        aria-label="Default select example" id="perfil" name="perfil" required>
                                    <?php
                                    foreach ($perfiles as $row1) {
                                        $selected = ($perfilUsuario['TipoPerfil'] == $row1['TipoPerfil']) ? 'selected' : '';
                                        echo '<option value="' . $row1['TipoPerfil'] . '" ' . $selected . '>' . $row1['TipoPerfil'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col">
                                <label for="perfil">Centro Médico:</label>
                                <select required class="form-select" style="width: 100%"
                                        aria-label="Default select example" id="centro" name="centro" required>
                                    <?php
                                    foreach ($centros as $row2) {
                                        $selected = ($centroUsuario['NombreCentro'] == $row2['NombreCentro']) ? 'selected' : '';
                                        echo '<option value="' . $row2['NombreCentro'] . '" ' . $selected . '>' . $row2['NombreCentro'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="IDUsuario" value="<?php echo $row['IDUsuario']; ?>">
                            <input type="hidden" name="op" value="Modificar">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" name="modificar" class="btn"
                                    style="color:white; background-color:#023059" value="Modificar">Modificar
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } else if ($IDUsuario == 0) { ?>

    <div class="modal fade" id="editar_Modal_0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="mantenedorusuarios.php" onsubmit="return validateForm()" >
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="nombre">Nombre Completo:</label>
                                <input required type="text" class="form-control" name="nombre">
                            </div>
                            <div class="col">
                                <label for="rut">Rut:</label>
                                <input required type="text" class="form-control" name="rut" id="rut">
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="usuario">Usuario:</label>
                                <input required type="text" class="form-control" name="usuario">
                            </div>
                            <div class="col">
                                <label for="clave">Clave:</label>
                                <input required type="text" class="form-control" name="clave">
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="correo">Correo:</label>
                                <input required type="text" class="form-control" name="correo">
                            </div>

                        </div>

                        <br>


                        <div class="row">
                            <div class="col">
                                <label for="perfil">Perfil:</label>
                                <select required class="form-select" style="width: 100%"
                                        aria-label="Default select example" id="perfil" name="perfil" required>
                                    <?php
                                    foreach ($perfiles as $row1) {
                                        echo '<option value=' . $row1['TipoPerfil'] . '>' . $row1['TipoPerfil'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col">
                                <label for="perfil">Centro Médico:</label>
                                <select required class="form-select" style="width: 100%"
                                        aria-label="Default select example" id="centro" name="centro" required>
                                    <?php
                                    foreach ($centros as $row2) {
                                        echo '<option value=' . $row2['NombreCentro'] . '>' . $row2['NombreCentro'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="op" value="GUARDAR">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="Guardar" class="btn"
                                    style="color:white; background-color:#023059" value="Guardar">Guardar
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/validate.js"></script>
<?php } ?>