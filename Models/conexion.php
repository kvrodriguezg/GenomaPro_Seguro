<?php
require_once(__DIR__ . '/../vendor/autoload.php');
use Dotenv\Dotenv;

// Cargar el archivo .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

 function Conectarse()
{
    $username=$_ENV['USERNAMECONEXION'];
    $password=$_ENV['PASSWORDCONEXION'];
    $bdd=$_ENV['BDDCONEXION'];
    if (!($link = mysqli_connect("localhost", $username, $password))) {
        echo "ERROR 1";
        exit();
    }

    $db_nombre = $bdd;

    //Validamos si existe.
  $db_existe = mysqli_select_db($link, $db_nombre);

        // Si la base de datos no existe, crearla
        if (!$db_existe) {
            $query = "CREATE DATABASE $db_nombre";
            if (!mysqli_query($link, $query)) {
                echo "Error 2";
            }
        } else {
        
            if (!mysqli_select_db($link, $db_nombre)) {
                echo "Error 3";
                exit();
            }
        }
        return $link;
} 
