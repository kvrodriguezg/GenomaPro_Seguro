<?php
require_once(__DIR__ . '/../vendor/autoload.php');
use Dotenv\Dotenv;

// Cargar el archivo .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$bdd=$_ENV['BDDCONEXION'];
$username=$_ENV['USERNAMECONEXION'];
$password=$_ENV['PASSWORDCONEXION'];
$conexion = mysqli_connect("localhost", $bdd, $username, $password);

//AQUI PROBAMOS LA CONEXION A LA BASE DE DATO
if (mysqli_connect_errno()) {
    echo "Falla a conectarce a la base de dato: " . mysqli_connect_errno();
} /* else {
    echo "Conectado correctamente";
} */
