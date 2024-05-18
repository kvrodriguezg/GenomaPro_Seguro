<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;

class CentroMedico
{
    private $id;
    private $nombreCentro;
    private $codigo;
    private $centros;
    private $db;
    private $listadoExamenesCentro;
    public function __construct()
    {
        //require_once("conexion.php");
        $this->db = Conectarse();
        $this->centros = array();
        $this->listadoExamenesCentro = array();
    }

    public function crearCentros()
    {

        $query = "INSERT INTO CentrosMedicos (NombreCentro, codigo) VALUES ('MEGAMAN', 'MM'),('ULTRAMAN', 'UM'),('ULTRASEVEN', 'US');";
        $creacion = mysqli_query($this->db, $query);
        if (!$creacion) {
            echo "Error al crear datos " . mysqli_error($this->db);
        }
        return true;
    }

    public function verCentros()
    {
        $consulta = mysqli_query($this->db, "select * from CentrosMedicos;");
        while ($filas = mysqli_fetch_array($consulta)) {
            $this->centros[] = $filas;
        }
        return $this->centros;
    }





    public function insertarCentro($nombreCentro, $CodigoCentro)
    {


        $query = "INSERT INTO CentrosMedicos (NombreCentro, codigo)  VALUES (?,?);";

        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "ss", $nombreCentro, $CodigoCentro);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            }
        }
    }

    public function modificarCentro($IDCentroMedico, $NombreCentro, $codigo)
    {
        $query = "UPDATE CentrosMedicos SET NombreCentro = ?, codigo = ? WHERE IDCentroMedico = ?;";
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "ssi", $NombreCentro, $codigo, $IDCentroMedico);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }
    }



    public function eliminarCentro($IDCentroMedico)
    {
        $query = "DELETE FROM CentrosMedicos WHERE IDCentroMedico = ?;";
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $IDCentroMedico);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function buscarExamenes($IDCentroMedico)
    {
        $query = "select p.NombrePaciente,e.NombreExamen,e.IDEstado,e.IDExamen,e.RutPaciente,e.FechaTomaMuestra,e.FechaRecepcion,es.NombreEstado from Examenes e  Join Pacientes p on e.RutPaciente = p.RutPaciente Join Estados es on es.IDEstado = e.IDEstado where IDCentroSolicitante = $IDCentroMedico";
        $consulta = mysqli_query($this->db, $query);
        while ($filas = mysqli_fetch_array($consulta)) {
            $this->listadoExamenesCentro[] = $filas;
        }
        return $this->listadoExamenesCentro;
    }


    public function nombreCentro($IDCentroMedico)
    {
        $consulta = "select NombreCentro from CentrosMedicos where IDCentroMedico = ?";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "i", $IDCentroMedico);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $NombreCentro);
                mysqli_stmt_fetch($stmt);
                return $NombreCentro;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function buscarCentroPorID($id)
    {
        $consulta = "SELECT * FROM centrosmedicos WHERE IDCentroMedico = $id";
        $resultado = mysqli_query($this->db, $consulta);
        if (mysqli_num_rows($resultado) > 0) {
            $resultado2 = mysqli_fetch_assoc($resultado);
            return $resultado2;
        } else {
            return null;
        }
    }
}
