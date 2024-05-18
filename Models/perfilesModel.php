<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;
class perfiles
{
    private $db;
    private $perfiles;
    private $tipoperfiles;
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

            $query = "INSERT INTO Perfiles (TipoPerfil) VALUES ('Administrador'),('Recepcionista'),('Tecnico Tincion'),('Tecnico Diagnostico'),('Tecnico Registro'),('Centro medico');";
            $creacion = mysqli_query($this->db, $query);
            if (!$creacion) {
                echo "Error al crear la tabla Perfiles: " . mysqli_error($this->db);
            }
            return true;
        
    }
    
    public function insertarPerfil($nombrePerfil)
    {
            $query = "INSERT INTO Perfiles (TipoPerfil) VALUES (?);";
            
            if ($stmt = mysqli_prepare($this->db, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $nombrePerfil);
                if (mysqli_stmt_execute($stmt)) {
                    return true;       
                } 
            }
        
    }

    public function eliminarPerfil($IDPerfil){
        $query="DELETE FROM Perfiles WHERE IDPerfil=?;";
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $IDPerfil);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }

        }
    }
    public function modificarPerfil($IDPerfil, $TipoPerfil)
    {
        $query = "UPDATE Perfiles SET TipoPerfil = ? WHERE IDPerfil = ?;"; // LA CONSULTA QUE QUIERO EJECUTAR
        if ($stmt = mysqli_prepare($this->db, $query)) { // LE AVISO AL EDITOR QUE LE ENVIARE UNA CONSULTA PREPARADA
            mysqli_stmt_bind_param($stmt, "si", $TipoPerfil, $IDPerfil); // LE INDICO A LA CONSULTA PREPARADA STMT 
                                                                                //QUE DATOS NECESITO QUE VALIDE
            if (mysqli_stmt_execute($stmt)) { //EJECUTO LA CONSULTA PREPARADA YA CON LOS DATOS QUE LE ENVIE
                return true; //SI TODO VA BIEN, SE EJECUTA Y RETORNA TRUE
            } else {
                return false; // SI HAY ALGO RARO EN LA CONSULTA RETORNA FALSE
            }
        }
    }
    
    

    public function verPerfiles(){
        $consulta = mysqli_query($this->db, "select * from Perfiles");
        while ($filas = mysqli_fetch_array($consulta)) {
            $this->perfiles[] = $filas;
        }
        return $this->perfiles;
    }

    public function vertipoPerfiles(){
        $consulta = mysqli_query($this->db, "select TipoPerfil from Perfiles");
        while ($filas = mysqli_fetch_array($consulta)) {
            $this->tipoperfiles[] = $filas;
        }
        return $this->tipoperfiles;
    }

    public function buscarPerfil($IDPerfil) {
        $consulta = "SELECT TipoPerfil FROM perfiles WHERE IDPerfil = ?";
        if ($stmt = mysqli_prepare($this->db, $consulta)) {
            mysqli_stmt_bind_param($stmt, "i", $IDPerfil); 
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $tipoPerfil); 
                mysqli_stmt_fetch($stmt);    
                return $tipoPerfil;
            } else {               
                return false;
            }
        } else {
            return false;
        }
    }
    public function buscarPerfiles()
    {
        $perfiles = array();
        $consulta = mysqli_query($this->db, "SELECT * FROM Perfiles");
        
        while ($perfil = mysqli_fetch_array($consulta)) {
            $perfiles[] = $perfil;
        }
        
        return $perfiles;
    }
    

}
