<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;

class Paciente
{
    private $db;
    public function __construct()
    {
        $this->db = Conectarse();
    }

    public function MostrarPacientes()
    {
        $consulta = mysqli_query($this->db, "CALL p_pacientes_select");
        while ($filas = mysqli_fetch_assoc($consulta)) {
            $pacientes[] = $filas;
        }
        return $pacientes;
    }

    public function InsertarPaciente($rut, $nombre, $domicilio)
    {
        $consulta = "CALL p_pacientes_insert (?, ?, ?)";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "sss", $rut, $nombre, $domicilio);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        }
    }

    public function EliminarPaciente($rutPaciente)
    {
        $ordenEliminar = "CALL p_pacientes_delete (?);";
        if ($stmt = mysqli_prepare($this->db, $ordenEliminar)) {
            mysqli_stmt_bind_param($stmt, "s", $rutPaciente);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        }
    }
    public function buscarPacientePorRut($rut)
    {
        $consulta = "CALL p_pacientes_select_by_rut (?)";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "s", $rut);

            if (mysqli_stmt_execute($stmt)) {
                $resultado = mysqli_stmt_get_result($stmt);
                $fila = mysqli_fetch_assoc($resultado);
                mysqli_free_result($resultado);
                mysqli_stmt_close($stmt);
                return $fila;
            } else {
                mysqli_stmt_close($stmt);
                return null;
            }
        } else {
            return null;
        }
    }

    public function ModificarPaciente($nombre, $rutNuevo, $domicilio, $rutActual)
    {
        $consulta = "CALL p_pacientes_update (?,?,?,?)";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "ssss", $nombre, $rutNuevo, $domicilio, $rutActual);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        }
    }

    public function validarut($rut)
    {
        $rut = strtoupper($rut ?? '');
        $a = 0;
        $suma = 0;
        $estado = "";
        //Validamos largo del RUT. En caso de ser menor a 10 se agregarán 0 a la izquierda.
        if (strlen($rut) < 10) {
            $rut = str_pad($rut, 10, '0', STR_PAD_LEFT);
        }
        if (strlen($rut) > 10) {
            return $estado = "MAL";
        }
        //Validamos que lo ingresado antes del guión seán números.
        for ($i = 0; $i < 8; $i++) {
            if (!is_numeric($rut[$i])) {
                return $estado = "MAL";
            }
        }
        //Validamos que el dígito verificador sea K o número.
        if (!is_numeric($rut[9]) && $rut[9] != 'K') {
            return $estado = "MAL";
        }

        //Validamos posición correcta del guión.
        if ($rut[8] != '-') {
            $estado = "MAL";
        } else {
            //Definimos arreglo con números para el cálculo.
            $calculo = array(3, 2, 7, 6, 5, 4, 3, 2, 11);

            //Realizamos operaciones.
            for ($i = 0; $i < 8; $i++) {
                $a = intval($rut[$i]) * $calculo[$i];
                $suma = $suma + $a;
            }
            $divisiondecimal = $suma / $calculo[8];
            $divisionentero = intval($divisiondecimal);
            $valordecimal = $divisiondecimal - $divisionentero;
            $resta11 = round($calculo[8] - ($calculo[8] * $valordecimal));
            $digito = intval($resta11);

            //Realizamos validaciones para definir si se encuentra correcto el dígito verificador ingresado.
            if ($rut[9] == 'K') {
                if ($digito == 10) {
                    $estado = "BIEN";
                } else {
                    $estado = "MAL";
                }
            } else if (($digito == 11 && intval($rut[9]) == 0) || ($digito == intval($rut[9]))) {
                $estado = "BIEN";
            } else if ($digito == 11) {
                $estado = "MAL";
            } else if ($digito == 10) {
                $estado = "MAL";
            } else {
                $estado = "MAL";
            }
        }
        return $estado;
    }
}
