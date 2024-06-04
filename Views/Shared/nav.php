<?php
include __DIR__ .'/../../route.php';
?>
<header class="navbar navbar-light fixed-top" style="background-color: #023059;">
<div class="nav-container">
        <a class="navbar-brand" href="../index.php">
            <img src="../img/4.png" alt="Logo">
        </a>
    <nav class="nav-ul">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link text-blue" href="<?= USUARIOS ?>" style="color:#FFFFFF"> <i class="fa-regular fa-user" style="color: #FFFFFF;"></i> Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-blue" href="<?= DIAGNOSTICO ?>" style="color:#FFFFFF"><i class="fa-solid fa-microscope" style="color: #FFFFFF;"></i> Diagnostico</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-blue" href="<?= LABORATORIOS ?>" style="color:#FFFFFF"><i class="fa-regular fa-hospital" style="color: #FFFFFF;"></i>Centros Médicos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-blue" href="<?= ESTADOS ?>" style="color:#FFFFFF"><i class="fa-solid fa-bars" style="color: #FFFFFF;"></i> Estados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-blue" href="<?= PERFILES ?>" style="color:#FFFFFF"><i class="fa-solid fa-users" style="color: #FFFFFF;"></i> Perfiles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-blue"  href="<?= REPORTE ?>"style="color:#FFFFFF"><i class="fa-regular fa-file" style="color: #FFFFFF;"></i> Reporte</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-blue"  href="<?= LOGOUT ?>" style="color:#FFFFFF"> <i class="fa-solid fa-right-from-bracket" style="color: #FFFFFF;"></i> Cerrar Sesi&oacuten</a>
            </li>
        </ul>
    </nav>
</div>
</header>
