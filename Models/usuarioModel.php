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
    private $IDUsuario;
    private $Usuario;
    private $Nombre;
    private $Correo;
    private $Rut;
    private $clave;
    private $IDPerfil;
    private $CentroMedico;
    private $probando;
    private $centrosarray;
    private $md;

    // Métodos Get
    public function getIDUsuario()
    {
        return $this->IDUsuario;
    }

    public function getUsuario()
    {
        return $this->Usuario;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getCorreo()
    {
        return $this->Correo;
    }

    public function getRut()
    {
        return $this->Rut;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getIDPerfil()
    {
        return $this->IDPerfil;
    }

    public function getCentroMedico()
    {
        return $this->CentroMedico;
    }

    // Métodos Set
    public function setIDUsuario($IDUsuario)
    {
        $this->IDUsuario = $IDUsuario;
    }

    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;
    }

    public function setRut($Rut)
    {
        $this->Rut = $Rut;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    public function setIDPerfil($IDPerfil)
    {
        $this->IDPerfil = $IDPerfil;
    }

    public function setCentroMedico($CentroMedico)
    {
        $this->CentroMedico = $CentroMedico;
    }


    public function __construct()
    {
        $this->db = Conectarse();
        $this->usuario = array();
        $this->user = array();
        $this->userLogin = array();
        $this->centrosarray = array();
    }

    public function verCentrosarray()
    {
        $procedure = "CALL u_users_centrosarray()";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            die('Error al obtener los resultados: ' . mysqli_error($this->db));
        }
        $centrosArray = array();
        while ($centro = mysqli_fetch_array($result)) {
            $centrosArray[] = $centro['NombreCentro'];
        }
        mysqli_stmt_close($stmt);
        return $centrosArray;
    }
    public function verUsuarios()
    {
        $this->md = Conectarse();
        $query = "CALL u_users_allusers";
        $consulta = mysqli_query($this->md, "$query");
        while ($filas = mysqli_fetch_array($consulta)) {
            $this->usuario[] = $filas;
        }
        return $this->usuario;
    }


    public function buscarPerfil($nombrePerfil)
    {
        $procedure = "CALL u_users_bperfil(?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_bind_param($stmt, "s", $nombrePerfil);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        } else {
            return false;
        }
        mysqli_stmt_close($stmt);
        // Devolver solo el ID del perfil
        if ($row) {
            return $row['IDPerfil']; // Ajusta esto al nombre correcto de la columna
        } else {
            return null; // O manejar el caso de que no se encuentre ningún perfil con ese nombre
        }
    }

    public function buscarPerfiles()
    {
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

    public function buscarCentros()
    {
        if (!$this->db) {
            die('Error al conectarse a la base de datos');
        }
        $procedure = "CALL u_users_selectall";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            die('Error al obtener los resultados: ' . mysqli_error($this->db));
        }
        $centros = array();
        while ($centro = mysqli_fetch_array($result)) {
            $centros[] = $centro;
        }
        mysqli_stmt_close($stmt);
        return $centros;
    }



    public function buscarcentro($nombreCentro)
    {
        $procedure = "CALL u_users_bcentro(?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_bind_param($stmt, "s", $nombreCentro);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            die('Error al obtener los resultados: ' . mysqli_error($this->db));
        }
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        // Devolver solo el ID del centro médico
        if ($row) {
            return $row['IDCentroMedico']; // Suponiendo que la columna se llama idCentroMedico
        } else {
            return null; // O manejar el caso de que no se encuentre ningún centro médico con ese nombre
        }
    }
    public function insertarcodigo($codigo, $userId)
    {
        // Generar una clave única para el cifrado
        $claveCifrado = random_bytes(32); // Longitud de la clave, 32 bytes para AES-256
        $iv = random_bytes(16); // IV para AES-256-CBC, 16 bytes

        // Cifrar el código usando AES-256-CBC
        $codigoCifrado = openssl_encrypt($codigo, 'aes-256-cbc', $claveCifrado, 0, $iv);

        // Generar un hash del código original
        $hashCodigo = hash('sha256', $codigo, true);

        // Consulta SQL para insertar el código cifrado, la clave y el hash en la base de datos
        $sql = "INSERT INTO codigos (codigo, clave_cifrado, iv, hash_codigo, id_usuario) VALUES (?, ?, ?, ?, ?)";

        // Preparar la consulta
        if ($stmt = mysqli_prepare($this->db, $sql)) {
            // Enlazar parámetros
            mysqli_stmt_bind_param($stmt, "ssssi", $codigoCifrado, $claveCifrado, $iv, $hashCodigo, $userId);

            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                // La inserción fue exitosa
                mysqli_stmt_close($stmt); // Cerrar el statement
                return true;
            } else {
                // Error al ejecutar la consulta
                mysqli_stmt_close($stmt); // Cerrar el statement
                return false;
            }
        } else {
            // Error al preparar la consulta
            return false;
        }
    }




    public function eliminarCodigo($codigo)
    {
        $hashCodigo = hash('sha256', $codigo, true);

        $sql = "DELETE FROM codigos WHERE hash_codigo = ?";

        if ($stmt = mysqli_prepare($this->db, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $hashCodigo);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        } else {
            return false;
        }
    }



    public function insertarUsuario($usuario, $nombre, $correo, $rut, $clave, $perfil, $centro)
    {
        $clavehash = password_hash($clave, PASSWORD_DEFAULT);

        // Verificar si ya existe un usuario con la misma llave foránea
        $existingUser = $this->buscarUsuarioPorLlaveForanea($rut);
        if ($existingUser) {
            return false;
        } else {
            $query = "CALL u_users_savedate(?, ?, ?, ?, ?, ?, ?, @resultado);";

            if ($stmt = mysqli_prepare($this->db, $query)) {
                mysqli_stmt_bind_param($stmt, "iisssss",  $centro, $perfil, $usuario, $nombre, $correo, $rut, $clavehash);

                if (mysqli_stmt_execute($stmt)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }


    public function buscarUsuarioPorLlaveForanea($rut)
    {
        $query = "CALL u_users_findfk(?)";
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
        return false;
    }

    public function eliminarUsuario($IDUsuario)
    {
        $query = "CALL u_users_delete(?)";
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $IDUsuario);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function buscarUsuarioporID($IDUsuario)
    {
        $procedure = "CALL u_users_buserid(?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_bind_param($stmt, "i", $IDUsuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            die('Error al obtener los resultados: ' . mysqli_error($this->db));
        }
        $Usuario = mysqli_fetch_array($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        return $Usuario;
    }

    public function buscarPerfilId($IDPerfil)
    {
        $procedure = "CALL u_users_bperfilid(?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_bind_param($stmt, "i", $IDPerfil);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            die('Error al obtener los resultados: ' . mysqli_error($this->db));
        }
        $TipoPerfil = mysqli_fetch_array($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        return $TipoPerfil;
    }


    public function buscarcentroID($IDCentroMedico)
    {
        $procedure = "CALL u_users_bcentroid(?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_bind_param($stmt, "i", $IDCentroMedico);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            die('Error al obtener los resultados: ' . mysqli_error($this->db));
        }
        $NombreCentro = mysqli_fetch_array($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        return $NombreCentro;
    }
    public function modificarPerfil($IDUsuario, $usuario, $nombre, $correo, $rut, $clave, $perfilM, $centroM)
    {

        $newclavehash = password_hash($clave, PASSWORD_DEFAULT);
        $procedure = "CALL u_users_modificarPerfil(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            return 'Error al preparar la consulta: ' . mysqli_error($this->db);
        }
        mysqli_stmt_bind_param($stmt, "sssssiii", $usuario, $nombre, $correo, $rut, $newclavehash, $perfilM, $centroM, $IDUsuario);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return 'Error al ejecutar la consulta: ' . mysqli_error($this->db);
        }
    }


    function accessStart($usuario, $clave)
    {
        $procedure = "CALL u_users_iniciarSesion(?)";
        $stmt = mysqli_prepare($this->db, $procedure);
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->db));
        }
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUsuario, $resultadoUsuario, $resultadoClave, $correo, $idPerfil, $IDCentroMedico);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        if ($resultadoUsuario === $usuario && password_verify($clave, $resultadoClave)) {
            return array('idUsuario' => $idUsuario, 'idPerfil' => $idPerfil, 'IDCentroMedico' => $IDCentroMedico, 'correo' => $correo);
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
