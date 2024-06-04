<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;
class perfiles
{
    private $db;
    private $perfiles;
    private $tipoperfiles;
    private $TipoPerfil;

    public function getPerfiles()
    {
        return $this->perfiles;
    }

    public function setPerfiles($perfiles)
    {
        $this->perfiles = $perfiles;
    }


    public function __construct()
    {
        //require_once("conexion.php");
        $this->db = Conectarse();
        $this->perfiles = array();
        $this->tipoperfiles = array();
    }


    //esta funcion ayudara a insertar los perfiles ya definidos en cuanto se cree la tabla
    public function crearperfiles()
    {
        $procedure = "CALL u_users_crearPerfiles()";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }

    public function insertarPerfil($datos)
    {
        $tipoperfil = $datos;
        $procedure= "CALL u_perfil_savedate(?)";
        if ($stmt = mysqli_prepare($this->db, $procedure)) {
            mysqli_stmt_bind_param($stmt, "s", $tipoperfil);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            }
        }
        return false;
    }
    public function eliminarPerfil($IDPerfil){
        $query = "CALL u_perfil_delete(?)";
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $IDPerfil);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    public function modificarPerfil($IDPerfil, $TipoPerfil)
    {
        $procedure = "CALL u_perfil_modificarPerfil(?, ?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_bind_param($stmt, "is", $IDPerfil, $TipoPerfil);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    public function verPerfiles(){
        if (!$this->db) {
            die('Error al conectarse a la base de datos');
        }
        $procedure = "CALL u_users_bperfiles";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die('Error al obtener los resultados: ' . mysqli_error($this->db));
        }
        $perfiles = array();
        while ($perfil = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $perfiles[] = $perfil;
        }
        mysqli_stmt_close($stmt);
        return $perfiles;
    }

    public function vertipoPerfiles()
    {
        $procedure = "CALL u_perfil_vertipoPerfiles()";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            die('Error al obtener los resultados: ' . mysqli_error($this->db));
        }
        $tiposPerfiles = array();
        while ($tipoPerfil = mysqli_fetch_array($result)) {
            $tiposPerfiles[] = $tipoPerfil['TipoPerfil'];
        }
        mysqli_stmt_close($stmt);
        return $tiposPerfiles;
    }


    public function buscarPerfil($IDPerfil) {
        $procedure = "CALL u_perfil_bPerfil(?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_bind_param($stmt, "i", $IDPerfil);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $tipoPerfil);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            return $tipoPerfil;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

}