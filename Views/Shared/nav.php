<?php
include_once(__DIR__ .'/../../route.php');
?>
<header class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #023059;">
	<div class="container-fluid" >
		<a class="navbar-brand" href="../index.php">
			<img src="../img/4.png" alt="Logo" style="width: 100px; height: 100px;">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="color: #FFF">
			<span class="navbar-toggler-icon" style=" background-color: white; /* Cambia el color de fondo */
    border: none; /*"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<a class="nav-link" href="<?= USUARIOS ?>" style="color:#FFFFFF"> <i class="fa-regular fa-user" style="color: #FFFFFF;"></i> Usuarios</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= DIAGNOSTICO ?>" style="color:#FFFFFF"><i class="fa-solid fa-microscope" style="color: #FFFFFF;"></i> Diagnósticos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= LABORATORIOS ?>" style="color:#FFFFFF"><i class="fa-regular fa-hospital" style="color: #FFFFFF;"></i> Centros Médicos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= ESTADOS ?>" style="color:#FFFFFF"><i class="fa-solid fa-bars" style="color: #FFFFFF;"></i> Estados</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= PERFILES ?>" style="color:#FFFFFF"><i class="fa-solid fa-users" style="color: #FFFFFF;"></i> Perfiles</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= PACIENTES ?>" style="color:#FFFFFF"><i class="fa-solid fa-hospital-user" style="color: #FFFFFF;"></i> Pacientes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= REPORTE ?>" style="color:#FFFFFF"><i class="fa-regular fa-file" style="color: #FFFFFF;"></i> Reporte</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= LOGOUT ?>" style="color:#FFFFFF"> <i class="fa-solid fa-right-from-bracket" style="color: #FFFFFF;"></i> Cerrar Sesión</a>
				</li>
			</ul>
		</div>
	</div>
</header>
