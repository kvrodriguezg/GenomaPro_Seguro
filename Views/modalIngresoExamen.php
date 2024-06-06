<?php
$directorioActual = __DIR__;
$rutaexamenes = dirname($directorioActual) . "/Controllers/examenesController.php";
require_once $rutaexamenes;
?>

<script>
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
<div class="modal fade" id="editar_Modal_0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Examen:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="recepcion.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="nombrePaciente">Nombre Paciente</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="col">
                            <label for="rut">Rut</label>
                            <input type="text" class="form-control" name="rut" id="rut" oninput="agregarGuion()"
                                   maxlength="10" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="domicilio">Domicilio</label>
                            <input type="text" class="form-control" name="domicilio" required>
                        </div>
                        <div class="col">
                            <label for="idcentromedico">Seleccionar Centro Médico</label>
                            <select class="form-select" name="idcentro" required>
                                <?php
                                while ($row = mysqli_fetch_array($centrosmedicos)) {
                                    echo "<option value=" . $row['IDCentroMedico'] . ">" . $row['NombreCentro'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="nombreexamen">Nombre Examen</label>
                            <select class="form-select" name="nombreexamen" required>
                                <option value="Parentesco">Parentesco</option>
                                <option value="Parentesco Prenatal">Parentesco Prenatal</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="fechaTomaMuestra">Fecha de Toma de Muestra</label>
                            <input type="date" class="form-control" name="fechamuestra" required>
                        </div>
                    </div>
                    <input type="hidden" name="fecharecepcion" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <input type="hidden" name="ingreso" value="ingresado">
                </div>
                <br>
                <div class="modal-footer">
                    <input type="submit" name="btnregistrar" class="btn center-block"
                           style="color:white; background-color:#023059" value="Registrar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>