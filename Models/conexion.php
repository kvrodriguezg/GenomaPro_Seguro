<?php

 function Conectarse()
{
    if (!($link = mysqli_connect("localhost", "root", ""))) {
        echo "ERROR 1";
        exit();
    }

    $db_nombre = "bddgenomapro";

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
