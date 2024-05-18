<?php

$conexion = mysqli_connect("localhost", "bddgenomapro", "root", "");

//AQUI PROBAMOS LA CONEXION A LA BASE DE DATO
if (mysqli_connect_errno()) {
    echo "Falla a conectarce a la base de dato: " . mysqli_connect_errno();
} /* else {
    echo "Conectado correctamente";
} */
