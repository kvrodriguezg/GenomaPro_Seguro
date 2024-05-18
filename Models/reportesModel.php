<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;

class ReportesModel {

    private $db;
    public function __construct()
    {
       // require_once("conexion.php");
        $this->db = Conectarse();
    }

    public function obtenerNombresCentrosMedicos() {
        $query = "SELECT NombreCentro FROM CentrosMedicos;";
        $result = mysqli_query($this->db, $query);

        $nombresCentros = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nombresCentros[] = $row['NombreCentro'];
            }
        }

        return $nombresCentros;
    }

    public function obtenerNombresDiagnosticos() {
        $query = "SELECT descripcion FROM Diagnosticos;";
        $result = mysqli_query($this->db, $query);

        $nombresDiagnosticos = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nombresDiagnosticos[] = $row['descripcion'];
            }
        }

        return $nombresDiagnosticos;
    }

    public function obtenerNombresExamenes() {
        $query = "SELECT NombreExamen FROM Examenes;";
        $result = mysqli_query($this->db, $query);
        $nombresExamenes = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nombreExamen = $row['NombreExamen'];
    
                if (!in_array($nombreExamen, $nombresExamenes)) {
                    $nombresExamenes[] = $nombreExamen;
                }
            }
        }

        return $nombresExamenes;
    }


    public function obtenerCantidadDiagnosticoPorCentro($centroMedico, $diagnostico) {
        $query = "SELECT COUNT(*) as cantidad FROM Examenes 
                  WHERE IDCentroSolicitante = (SELECT IDCentroMedico FROM CentrosMedicos WHERE NombreCentro = '$centroMedico') 
                  AND CodigoDiagnosticos = (SELECT codigo FROM Diagnosticos WHERE descripcion = '$diagnostico');";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['cantidad'];
        } else {
            return 0;
        }
    }

    public function obtenerCantidadExamenesPorCentro($centroMedico, $examen) {
        $query = "SELECT COUNT(*) as cantidad FROM Examenes 
        WHERE IDCentroSolicitante = (SELECT IDCentroMedico FROM CentrosMedicos WHERE NombreCentro = '$centroMedico') 
        AND NombreExamen = '$examen';";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['cantidad'];
        } else {
            return 0;
        }
    }
}