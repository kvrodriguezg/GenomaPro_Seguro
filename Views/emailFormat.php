<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo de Verificación de GnomaPro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333333;
            margin: 0;
        }

        .code {
            background-color: #3498db;
            color: #ffffff;
            font-size: 24px;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777777;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Verificación en Dos Pasos - GnomaPro</h1>
    </div>
    <p>Hola,</p>
    <p>Has solicitado un código de verificación para acceder a tu cuenta en GnomaPro. Por favor, utiliza el siguiente
        código para completar el proceso de verificación:</p>
    <div class="code">' . $codigo . '</div>
    <p>Por favor, no compartas este código con nadie. Si no has solicitado este código, ignora este correo
        electrónico.</p>
    <p>Gracias,<br>El equipo de GnomePro</p>
    <div class="footer">
        <p>&copy; 2024 GnomaPro. Todos los derechos reservados.</p>
    </div>
</div>
</body>

</html>