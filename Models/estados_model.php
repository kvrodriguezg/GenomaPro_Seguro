<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;

class Estados
{
    private $db;
    private $Estados;
    public function __construct()
    {
        $this->db = Conectarse();
        $this->Estados = array();
    }

    public function InsertaEstado($nuevoEstado, $nuevoPerfil)
    {
        $consulta = "CALL e_estados_insert (?, ?)";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "si", $nuevoEstado, $nuevoPerfil);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function MostrarEstados()
    {
        $consulta = mysqli_query($this->db, "CALL e_estados_select");
        while ($filas = mysqli_fetch_assoc($consulta)) {
            $this->Estados[] = $filas;
        }
        return $this->Estados;
    }
    public function buscarEstadoPorID($id)
    {
        $consulta = "CALL e_estados_select_by_id (?)";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
    
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

    public function ModificarEstado($nuevoEstado, $nuevoPerfil, $idEstados)
    {

        $consulta = "CALL e_estados_update (?,?,?)";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "sii", $nuevoEstado, $nuevoPerfil, $idEstados);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function EliminaEstado($idEstado)
    {
        $ordenEliminar = "CALL e_estados_delete (?);";
        if ($stmt = mysqli_prepare($this->db, $ordenEliminar)) {
            mysqli_stmt_bind_param($stmt, "i", $idEstado);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        }
    }
}
