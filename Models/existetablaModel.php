<?php
$directorioActual = __DIR__;
$ruta = dirname($directorioActual) . "/Models/conexion.php";
require_once $ruta;
class ExisteTabla
{
    private $db;
    public function __construct()
    {
        $this->db = Conectarse();
    } 

    public function comprobarTabla($tabla)
    {
        $query = "SHOW TABLES LIKE '$tabla';";
        $existe = mysqli_query($this->db, $query);
        if (mysqli_num_rows($existe) == 0) {
            return false;
        }
        return true;
    }

    private function crearTabla($nombreTabla, $sql)
    {
        $query = "CREATE TABLE IF NOT EXISTS $nombreTabla ($sql);";
        $creacion = mysqli_query($this->db, $query);
        if (!$creacion) {
            echo "Error al crear la tabla $nombreTabla: " . mysqli_error($this->db);
        }
    }


    public function crearTablas()
    {
        $this->crearTabla("Perfiles", "IDPerfil INT PRIMARY KEY AUTO_INCREMENT, TipoPerfil VARCHAR(50) NOT NULL");
        $this->crearTabla("CentrosMedicos", "IDCentroMedico INT PRIMARY KEY AUTO_INCREMENT, NombreCentro VARCHAR(100) NOT NULL, codigo VARCHAR(5) NOT NULL");
        $this->crearTabla("Usuarios", "IDUsuario INT PRIMARY KEY AUTO_INCREMENT, usuario varchar(50), Nombre VARCHAR(50) NOT NULL, Correo VARCHAR(50) NOT NULL, Rut VARCHAR(10) UNIQUE NOT NULL, Clave VARCHAR(100) NOT NULL, IDPerfil INT NOT NULL, IDCentroMedico INT, FOREIGN KEY (IDCentroMedico) REFERENCES CentrosMedicos(IDCentroMedico), FOREIGN KEY (IDPerfil) REFERENCES Perfiles(IDPerfil)");
        $this->crearTabla("Pacientes", "NombrePaciente VARCHAR(100) NOT NULL, RutPaciente VARCHAR(12) PRIMARY KEY NOT NULL, DomicilioPaciente VARCHAR(200) NOT NULL");
        $this->crearTabla("Diagnosticos", "Codigo VARCHAR(2) NOT NULL PRIMARY KEY , descripcion VARCHAR(255) NOT NULL");
        $this->crearTabla("Estados", "IDEstado INT PRIMARY KEY AUTO_INCREMENT, NombreEstado VARCHAR(100) UNIQUE NOT NULL, IDPerfil INT, FOREIGN KEY (IDPerfil) REFERENCES Perfiles(IDPerfil)");
        $this->crearTabla("Examenes", "IDExamen INT PRIMARY KEY AUTO_INCREMENT, NombreExamen VARCHAR(100) NOT NULL, RutPaciente VARCHAR(12) NOT NULL, IDCentroSolicitante INT NOT NULL, IDEstado INT NOT NULL, CodigoDiagnosticos VARCHAR(5), FechaTomaMuestra DATE NOT NULL, FechaRecepcion DATETIME NOT NULL, Fechatincion DATETIME, Fechadiagnostico DATETIME, FOREIGN KEY (CodigoDiagnosticos) REFERENCES Diagnosticos(Codigo), FOREIGN KEY (IDCentroSolicitante) REFERENCES CentrosMedicos(IDCentroMedico), FOREIGN KEY (RutPaciente) REFERENCES Pacientes(RutPaciente), FOREIGN KEY (IDEstado) REFERENCES Estados(IDEstado)");
    }


    public function crearCentros()
    {
        if ($this->comprobarTabla("CentrosMedicos") == true) {
            $query = "INSERT IGNORE INTO CentrosMedicos (NombreCentro, codigo) VALUES 
                ('NA', 'NA'),
                ('MEGAMAN', 'MM'),
                ('ULTRAMAN', 'UM'),
                ('ULTRASEVEN', 'US');";
            $creacion = mysqli_query($this->db, $query);
    
            if (!$creacion) {
                echo "Error al crear datos " . mysqli_error($this->db);
            }
    
            return true;
        } else {
            return false;
        }
    }
    
    public function crearDiagnosticos()
    {
        if ($this->comprobarTabla("Diagnosticos") == true) {
            $query = "INSERT IGNORE INTO Diagnosticos (codigo, descripcion) VALUES 
                ('N', 'NEGATIVO'),
                ('P', 'POSITIVO'),
                ('M', 'MUESTRA ATROFICA');";
            $creacion = mysqli_query($this->db, $query);
    
            if (!$creacion) {
                echo "Error al crear datos " . mysqli_error($this->db);
            }
    
            return true;
        } else {
            return false;
        }
    }
    
    public function crearPerfiles()
    {
        if ($this->comprobarTabla("Perfiles") == true) {
            $query = "INSERT IGNORE INTO Perfiles (TipoPerfil) VALUES
                ('diagnostico'),
                ('tincion'),
                ('recepcion'),
                ('registro'),
                ('administrador'),
                ('centromedico');";
            $creacion = mysqli_query($this->db, $query);
    
            if (!$creacion) {
                echo "Error al crear datos " . mysqli_error($this->db);
            }
    
            return true;
        } else {
            return false;
        }
    }
    
    public function crearEstados()
    {
        if ($this->comprobarTabla("Estados") == true) {
            $query = "INSERT IGNORE INTO Estados (NombreEstado, IDPerfil) VALUES 
                ('Recepcionado', (SELECT IDPerfil FROM Perfiles WHERE TipoPerfil = 'recepcion')),
                ('Listo para Diagnostico', (SELECT IDPerfil FROM Perfiles WHERE TipoPerfil = 'recepcion')),
                ('Realizado', (SELECT IDPerfil FROM Perfiles WHERE TipoPerfil = 'diagnostico'));";
            $creacion = mysqli_query($this->db, $query);
    
            if (!$creacion) {
                echo "Error al crear datos " . mysqli_error($this->db);
            }
    
            return true;
        } else {
            return false;
        }
    }
    
        private function obtenerIDCentroAdmin()
    {
        $query = "SELECT IDCentroMedico FROM CentrosMedicos WHERE NombreCentro = 'N/A'";
        $result = mysqli_query($this->db, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['IDCentroMedico'];
        }

        return null;
    }

    private function obtenerIDPerfilAdmin()
    {
        $query = "SELECT IDPerfil FROM Perfiles WHERE TipoPerfil = 'administrador'";
        $result = mysqli_query($this->db, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['IDPerfil'];
        }

        return null;
    }
    
        public function comprobarAdmin()
    {
        $query = "SELECT * FROM Usuarios WHERE usuario = 'admin'";
        $result = mysqli_query($this->db, $query);

        if ($result) {
            $existe = mysqli_num_rows($result);

            if ($existe > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "Error: " . mysqli_error($this->db);
            return false;
        }
    }

     public function crearUsuarioAdmin()
    {
        if ($this->comprobarTabla("Usuarios") == true) {
            $usuario = "admin";
            $nombre = "Administrador";
            $correo = "admin@admin.cl";
            $rut = "11111111-1";
            $clave = password_hash("adminLuisY", PASSWORD_DEFAULT);
            $idPerfilAdmin = $this->obtenerIDPerfilAdmin();
            $idCentroMedico = $this->obtenerIDCentroAdmin();

            $query = "INSERT IGNORE INTO Usuarios (usuario, Nombre, Correo, Rut, Clave, IDPerfil, IDCentroMedico) VALUES (?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($this->db, $query)) {
                mysqli_stmt_bind_param($stmt, "ssssssi", $usuario, $nombre, $correo, $rut, $clave, $idPerfilAdmin, $idCentroMedico);

                $result = mysqli_stmt_execute($stmt);

                if (!$result) {
                    echo "Error al crear el usuario admin: " . mysqli_error($this->db);
                    return false;
                }
                return true;
            } else {
                echo "Error: " . mysqli_error($this->db);
                return false;
            }
        } else {
            return false;
        }
    }
     
}