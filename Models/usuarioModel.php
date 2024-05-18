<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;
class usuario
{
    private $db;
    private $usuario;
    private $user;
    private $userLogin;


    private $centrosarray;

    public function __construct()
    {
        //sacar aqui
        //require_once("conexion.php");
        $this->db = Conectarse();
        $this->usuario = array();
        $this->user = array();
        $this->userLogin = array();
        $this->centrosarray = array();
    }

    public function verUsuarios()
    {
        $consulta = mysqli_query($this->db, "SELECT * FROM Usuarios");
        while ($filas = mysqli_fetch_array($consulta)) {
            $this->usuario[] = $filas;
        }
        return $this->usuario;
    }
    

    public function buscarPerfil($nombrePerfil)
    {
        $consulta = mysqli_query($this->db, "SELECT IDPerfil FROM Perfiles WHERE TipoPerfil = '$nombrePerfil'");
        $idperfil = mysqli_fetch_array($consulta);
        return $idperfil;
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

    public function buscarCentros()
    {
        $centros = array();
        $consulta = mysqli_query($this->db, "SELECT * FROM CentrosMedicos");
        
        while ($centro = mysqli_fetch_array($consulta)) {
            $centros[] = $centro;
        }
        
        return $centros;
    }

    public function buscarcentro($nombreCentro)
    {
        $consulta = mysqli_query($this->db, "SELECT IDCentroMedico FROM CentrosMedicos WHERE NombreCentro = '$nombreCentro'");
        $idcentro = mysqli_fetch_array($consulta);
        return $idcentro;
    }

    public function verCentrosarray()
    {
        $consulta = mysqli_query($this->db, "select NombreCentro from CentrosMedicos;");
        while ($filas = mysqli_fetch_array($consulta)) {
            $this->centrosarray[] = $filas;
        }
        return $this->centrosarray;
    }
    public function insertarUsuario($usuario, $nombre, $correo, $rut, $clave, $perfil, $centro)
    {
        $idperfil = $this->buscarPerfil($perfil);
        $idcentro = $this->buscarcentro($centro);
        $clavehash = password_hash($clave, PASSWORD_DEFAULT);

        // Verificar si ya existe un usuario con la misma llave foránea
        $existingUser = $this->buscarUsuarioPorLlaveForanea($rut);
        if ($existingUser) {
            return false;
        } else {
            $query = "INSERT INTO Usuarios (usuario, Nombre, Correo, Rut, Clave, IDPerfil, IDCentroMedico) VALUES (?, ?, ?, ?, ?, ?, ?);";

            if ($stmt = mysqli_prepare($this->db, $query)) {
                mysqli_stmt_bind_param($stmt, "sssssii", $usuario, $nombre, $correo, $rut, $clavehash, $idperfil['IDPerfil'], $idcentro['IDCentroMedico']);

                if (mysqli_stmt_execute($stmt)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

    }

    public function buscarUsuarioPorLlaveForanea($rut)
    {
        $query = "SELECT * FROM Usuarios WHERE Rut = ?";

        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $rut);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                return true; 
            } else {
                return false; 
            }
        }
    }

    public function eliminarUsuario($IDUsuario)
    {
        $query = "DELETE FROM Usuarios WHERE IDUsuario=?;";
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $IDUsuario);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function buscarUsuario($IDUsuario)
    {
        $consulta = mysqli_query($this->db, "SELECT * FROM Usuarios where IDUsuario=$IDUsuario");
        while ($filas = mysqli_fetch_array($consulta)) {
            $this->user[] = $filas;
        }
        return $this->user;
    }

    public function buscarUsuarioporID($IDUsuario)
    {
        $consulta = mysqli_query($this->db, "SELECT * FROM Usuarios where IDUsuario=$IDUsuario");
        $Usuario = mysqli_fetch_array($consulta);
        return $Usuario;
    }

    public function buscarPerfilId($IDPerfil)
    {
        $consulta = mysqli_query($this->db, "SELECT TipoPerfil FROM Perfiles WHERE IDPerfil = $IDPerfil");
        $TipoPerfil = mysqli_fetch_array($consulta);
        return $TipoPerfil;
    }

    public function buscarcentroID($IDCentroMedico)
    {
        $consulta = mysqli_query($this->db, "SELECT NombreCentro FROM CentrosMedicos WHERE  IDCentroMedico = '$IDCentroMedico'");
        $NombreCentro = mysqli_fetch_array($consulta);
        return $NombreCentro;
    }

    public function modificarPerfil($IDUsuario, $usuario, $nombre, $correo, $rut, $clave, $perfil, $centro)
    {

        $idperfil = $this->buscarPerfil($perfil);
        $idcentro = $this->buscarcentro($centro);

        $query = "UPDATE Usuarios SET usuario = ?,Nombre = ?, Correo = ?, Rut = ?, Clave = ?, IDPerfil = ?, IDCentroMedico = ? WHERE IDUsuario = ?;";
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "sssssiii", $usuario, $nombre, $correo, $rut, $clave, $idperfil['IDPerfil'], $idcentro['IDCentroMedico'], $IDUsuario);

            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }
    }

    function iniciarSesion($usuario, $clave)
    {
        $link = Conectarse();

        $query = mysqli_prepare($link, "SELECT usuario, Clave, Correo, idPerfil, IDCentroMedico FROM Usuarios WHERE usuario = ?");

        if ($query) {
            mysqli_stmt_bind_param($query, "s", $usuario);
            mysqli_stmt_execute($query);
            mysqli_stmt_bind_result($query, $resultadoUsuario, $resultadoClave, $correo, $idPerfil, $IDCentroMedico);
            mysqli_stmt_fetch($query);
            mysqli_stmt_close($query);

            if ($resultadoUsuario === $usuario && password_verify($clave, $resultadoClave)) {
                return array('idPerfil' => $idPerfil, 'IDCentroMedico' => $IDCentroMedico, 'correo' => $correo);
            }
        } else {
            return false;
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
