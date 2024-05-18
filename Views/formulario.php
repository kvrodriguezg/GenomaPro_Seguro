<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="~/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    
    <title>Document</title>
</head>
<body>

<header class="navbar navbar-light fixed-top" style="background-color: #9CD0FE;">
        <div class="container">
            <a class="navbar-brand" href="http://localhost/integrativagrupodiandra2.0/index.php">
                <img src="http://localhost/integrativagrupodiandra2.0/img/logo_labmuest.png" alt="" width="110" height="35">
            </a>
            <nav class="nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-blue" href="http://localhost/integrativagrupodiandra2.0/index.php"><i class="fa-solid fa-house"></i>inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" href="http://localhost/integrativagrupodiandra2.0/views/centro_medico.php"> <i class="fa-solid fa-stethoscope"></i>Centro Medico</a>
                    </li>
                    
                    <div class="m-1">
                        <button type="button" class="btn btn-outline-primary btn-sm ">libre</button>
                    </div>
                    <div class="m-1">
                        <button type="button" class="btn btn-outline-warning btn-sm">libre</button>
                    </div>

                </ul>
            </nav>
        </div>
</header>

<form method="POST"  class="form" style="padding: 100px 300px 0 300px;">
<h2 style="text-align: center;">formularios</h2>
    <div class="row">
        <div class="col">
            <label for="rut">Ingrese Nombre Completo</label>
            <input type="text" class="form-control" name="nombre">
        </div>
        <div class="col">
            <label for="nombre">Ingrese Rut</label>
            <input type="text" class="form-control" name="rut">
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col">
            <label for="paterno">Fecha de Ingreso</label>
            <input type="date" class="form-control" name="fecha">
        </div>
        <div class="col">
            <label for="materno">Nombre Centro Medico</label>
            <input type="text" class="form-control" name="CentroMedico">
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col">
            <label for="edad">nombre del Examen</label>
            <input type="text" class="form-control" name="nombreExamen">
        </div>
        <div class="col">
            <label for="edad">estado</label>
            <input type="text" class="form-control" name="estado">
        </div>
        <div class="col">
            <label for="edad">Acciones</label>
            <input type="text" class="form-control" name="acciones">
        </div>
    
        
    </div>

    <br>
    
    <button type="submit" class="btn btn-primary w-100 center-block" name="crearRegistro">Registro</button>
</form>

<section style="margin: 10px;">
    <table id="tableUsers" class="tabla table">
    <style>
        .tabla {
            width: 100%;
        }
        </style>
        <thead>
        <tr>
            <th>Nombre Completo</th>
            <th>Rut</th>
            <th>Fecha de Ingreso</th>
            <th>Dimicilio</th>
            <th>Centro Medico</th>
            <th>Examen</th>
            <th>Estado</th>
            <th>Acciones</th>
    
        </tr>
        </thead>
        <tbody>
            <tr class="table table-striped" >
                <td>luis yañez</td>
                <td>17426433-5</td>
                <td>12-12-2024</td>
                <td>Arturo prat 269</td>
                <td>indisa</td>
                <td>glisemia</td>
                <td>pendiente</td>
                <td>ingresado</td>
                <td>
                <a href="editar.php" class="btn w-100 m-1 btn-primary">editar</a>
                <a href="borrar.php" class="btn w-100 m-1 btn-danger">borrar</a>
                </td>
                <td>
                <a href="editar.php" class="btn w-100 m-1 btn-success">Enviar Ticion</a>
                <a href="borrar.php" class="btn w-100 m-1 btn-success">Enviar Registro</a>
                </td>
            </tr>
            <tr class="table table-striped" >
                <td>luis yañez</td>
                <td>17426433-5</td>
                <td>12-12-2024</td>
                <td>Arturo prat 269</td>
                <td>indisa</td>
                <td>glisemia</td>
                <td>pendiente</td>
                <td>ingresado</td>
                <td>
                <a href="editar.php" class="btn w-100 m-1 btn-primary">editar</a>
                <a href="borrar.php" class="btn w-100 m-1 btn-danger">borrar</a>
                </td>
                <td>
                <a href="editar.php" class="btn w-100 m-1 btn-success">Enviar Ticion</a>
                <a href="borrar.php" class="btn w-100 m-1 btn-success">Enviar Registro</a>
                </td>
            </tr>
            <tr class="table table-striped" >
                <td>luis yañez</td>
                <td>17426433-5</td>
                <td>12-12-2024</td>
                <td>Arturo prat 269</td>
                <td>indisa</td>
                <td>glisemia</td>
                <td>pendiente</td>
                <td>ingresado</td>
                <td>
                <a href="editar.php" class="btn w-100 m-1 btn-primary">editar</a>
                <a href="borrar.php" class="btn w-100 m-1 btn-danger">borrar</a>
                </td>
                <td>
                <a href="editar.php" class="btn w-100 m-1 btn-success">Enviar Ticion</a>
                <a href="borrar.php" class="btn w-100 m-1 btn-success">Enviar Registro</a>
                </td>
            </tr>
        </tbody>
    </table>
</section>



<script src="https://kit.fontawesome.com/4652dbea50.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>