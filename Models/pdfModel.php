<?php
//$directorioActual = __DIR__;
//$ruta = dirname($directorioActual) . "/Models/conexion.php";
//require_once $ruta;

class PDF
{
    private $db;
    private $PDF;
    public function __construct()
    {
        require_once("conexion.php");
        $this->db = Conectarse();
        $this->PDF = array();
    }


    public function ObtenerDatosPdf($IDSeleccionado)
    {
        $consulta = "select e.IDExamen, e.NombreExamen, e.RutPaciente, e.FechaTomaMuestra, 
        e.FechaRecepcion, e.Fechatincion, e.Fechadiagnostico,  e.CodigoDiagnosticos, 
        d.descripcion as DescripcionDiagnostico, p.NombrePaciente as NombreDelPaciente 
        from Examenes e join Diagnosticos d on e.CodigoDiagnosticos = d.Codigo 
        join Pacientes p ON e.RutPaciente = p.RutPaciente
        where e.IDExamen=?";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "i", $IDSeleccionado);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                // Obtener el resultado de la consulta
                $PDF = mysqli_fetch_assoc($result);
                return $PDF; // Devuelve los datos del examen
            } else {
                return false;
            }
        }




    }
}
?>
