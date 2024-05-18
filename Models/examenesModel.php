<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;
class examenesModel
{
    private $db;
    public function __construct()
    {
        //require_once("conexion.php");
        $this->db = Conectarse();
    }

    public function obtenerDatosExamenes()
    {
        $query = "SELECT * FROM Examenes;";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $result;
        }
    }

    public function obtenerExamenesDiagnosticos()
    {
        $query = "SELECT * FROM Examenes WHERE IDEstado = (SELECT IDEstado FROM Estados WHERE NombreEstado = 'Listo para Diagnostico')";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $result;
        }
    }

    public function obtenerExamenesRegistro()
    {
        $query = "SELECT * FROM Examenes WHERE IDEstado = (SELECT IDEstado FROM Estados WHERE NombreEstado = 'Realizado')";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $result;
        }
    }

    public function obtenerExamenesTincion()
    {
        $query = "SELECT * FROM Examenes WHERE IDEstado = (SELECT IDEstado FROM Estados WHERE NombreEstado = 'Listo para Tincion')";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $result;
        }
    }

    public function obtenerDomicilioPaciente($rut)
    {
        $query = "SELECT DomicilioPaciente FROM Pacientes WHERE RutPaciente='$rut';";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            $row = mysqli_fetch_array($result);
            return $row['DomicilioPaciente'];
        } else {
            echo "error" . mysqli_error($this->db);
        }
    }

    public function obtenerNombrePaciente($rut)
    {
        $query = "SELECT NombrePaciente FROM Pacientes WHERE RutPaciente='$rut';";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            $row = mysqli_fetch_array($result);
            return $row['NombrePaciente'];
        }
    }

    public function obtenerCentroMedico($idCentroMedico)
    {
        $query = "SELECT NombreCentro FROM CentrosMedicos WHERE IDCentroMedico =$idCentroMedico;";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            $row = mysqli_fetch_array($result);
            return $row['NombreCentro'];
        }
    }

    public function obtenerDiagnostico($codDiagnostico)
    {
        if ($codDiagnostico != null) {
            $query = "SELECT descripcion FROM Diagnosticos WHERE codigo ='$codDiagnostico';";
            $result = mysqli_query($this->db, $query);
            if ($result) {
                $row = mysqli_fetch_array($result);
                return $row['descripcion'];
            } else {
                return "error" . mysqli_query($this->db, $query);
            }
        } else {
            return " ";
        }
    }

    public function obtenerEstados($perfil)
    {
        $query = "SELECT * FROM Estados WHERE IDPerfil = (SELECT IDPerfil FROM Perfiles WHERE TipoPerfil= '$perfil')";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $result;
        }
    }

    public function obtenerEstadoActual($idEstado)
    {
        $query = "SELECT NombreEstado FROM Estados WHERE IDEstado = $idEstado;";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            $row = mysqli_fetch_array($result);
            return $row['NombreEstado'];
        }
    }

    public function cambiarEstado($idEstado, $idExamen)
    {
        $query = "UPDATE Examenes SET IDEstado = ? WHERE IDExamen = ?";

        $stmt = mysqli_prepare($this->db, $query);

        mysqli_stmt_bind_param($stmt, "ii", $idEstado, $idExamen);

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->db);
            return false;
        }
    }

    public function actualizarTincion($idExamen, $idEstado)
    {
        $fechaTincion = date("Y-m-d H:i:s");
        $query = "UPDATE Examenes SET IDEstado = $idEstado, Fechatincion = '$fechaTincion' WHERE IDExamen = $idExamen;";
        $result = mysqli_query($this->db, $query);

        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->db);
            return false;
        }
    }


    public function obtenerListaDiagnosticos()
    {
        $query = "SELECT * FROM Diagnosticos;";
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $result;
        }
    }
    public function actualizarDiagnostico($idExamen, $diagnostico)
    {
        $fechaDiagnostico = date("Y-m-d H:i:s");
        $query = "UPDATE Examenes SET CodigoDiagnosticos = '$diagnostico', Fechadiagnostico = '$fechaDiagnostico' WHERE IDExamen = $idExamen;";
        $result = mysqli_query($this->db, $query);

        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->db);
            return false;
        }
    }

    public function eliminarRegistro($idExamen)
    {
        $query = "DELETE FROM Examenes WHERE IDExamen = ?";

        $stmt = mysqli_prepare($this->db, $query);

        mysqli_stmt_bind_param($stmt, "i", $idExamen);

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->db);
            return false;
        }
    }

    public function insertarPaciente($nombre, $domicilio, $rut)
    {

        $nombre = mysqli_real_escape_string($this->db, $nombre);
        $domicilio = mysqli_real_escape_string($this->db, $domicilio);
        $rut = mysqli_real_escape_string($this->db, $rut);

        $query = "INSERT INTO Pacientes (NombrePaciente, DomicilioPaciente, RutPaciente) VALUES ('$nombre', '$domicilio', '$rut')";
        mysqli_query($this->db, $query);

        if (mysqli_error($this->db)) {

            echo "Error al insertar paciente: " . mysqli_error($this->db);
        }
    }

    public function validarPaciente($rut)
    {
        $query = "select * from Pacientes where RutPaciente = '$rut'";
        $existe = mysqli_query($this->db, $query);
        if (mysqli_num_rows($existe) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertarExamen($nombreexamen, $rut, $idcentrosoli, $fechamuestra, $fecharecepcion)
    {
        $nombreexamen = mysqli_real_escape_string($this->db, $nombreexamen);
        $rut = mysqli_real_escape_string($this->db, $rut);
        $idcentrosoli = mysqli_real_escape_string($this->db, $idcentrosoli);
        $fechamuestra = mysqli_real_escape_string($this->db, $fechamuestra);
        $fecharecepcion = mysqli_real_escape_string($this->db, $fecharecepcion);
        $query = "INSERT INTO Examenes (NombreExamen,RutPaciente,IDCentroSolicitante,FechaTomaMuestra,FechaRecepcion, IDEstado) VALUES ('$nombreexamen','$rut','$idcentrosoli','$fechamuestra',NOW(), (SELECT IDEstado FROM Estados WHERE NombreEstado = 'Recepcionado'));";
        $result = mysqli_query($this->db, $query);

        if ($result) {
            return $result;
        } else {
            return "Error: " . mysqli_error($this->db);
        }
    }

    public function obtenerCentrosmedicos()
    {
        $query = "SELECT * FROM CentrosMedicos";
        $result = mysqli_query($this->db, $query);

        if ($result) {
            return $result;
        } else {
            return "Error: " . mysqli_error($this->db);
        }
    }
    /*public function obtenerDomicilioPaciente($rut)
    {
        $query = "SELECT DomicilioPaciente FROM Pacientes WHERE RutPaciente = '$rut'";
        $result = mysqli_query($this->db, $query);

        if ($result) {
            $row = mysqli_fetch_row($result);
            return $row[0];
        } else {
            return "Error: " . mysqli_error($this->db);
        }
    }*/

    public function actualizarDomicilioPaciente($rut, $nuevoDomicilio)
    {
        $nuevoDomicilio = mysqli_real_escape_string($this->db, $nuevoDomicilio);

        $query = "UPDATE pacientes SET DomicilioPaciente = '$nuevoDomicilio' WHERE RutPaciente = '$rut'";
        mysqli_query($this->db, $query);

        if (mysqli_error($this->db)) {
            echo "Error al actualizar domicilio: " . mysqli_error($this->db);
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
