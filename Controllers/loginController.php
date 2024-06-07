<?php
require '../vendor/autoload.php';

use Dotenv\Dotenv;

// Cargar el archivo .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// Incluir los archivos de PHPMailer
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/SMTP.php';
require_once '../PHPMailer-master/src/Exception.php';
require __DIR__ . '/../vendor/autoload.php';

// Ahora puedes usar PHPMailer en tu script
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$directorioActual = __DIR__;
$rutausuario = dirname($directorioActual) . "/Models/usuarioModel.php";
require_once $rutausuario;

$objlogin = new usuario();

if (isset($_POST['op']) && $_POST['op'] == "LOGIN") {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Esta clave la proporciona la API
    $secret = $_ENV['RECAPTCHA_SECRET'];
    // Capturamos el captcha
    $response = $_POST['g-recaptcha-response'];
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
    $captcha_response = json_decode($verify);

    if ($captcha_response->success) {
        $loginResult = $objlogin->iniciarSesion($usuario, $clave);

        session_start();
        if ($loginResult) {
            $_SESSION['estado-verificacion']=0;
            $correo = $loginResult['correo'];
            $codigoUnico = generarCodigo();
            $_SESSION['codigo_verificacion'] = $codigoUnico;
            SendMail($correo, $codigoUnico);
            $idperfil = $loginResult['idPerfil'];
            $idcentro = $loginResult['IDCentroMedico'];
            $userId = $loginResult['idUsuario'];
            $username = $loginResult['username'];

            // Almacenar valores en la sesión
            $_SESSION['idPerfil'] = $idperfil;
            $_SESSION['idCentro'] = $idcentro;
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;

            header('Location: ../Views/verificacion.php');
        } else {
            $_SESSION['error'] = 'Usuario o contraseña incorrectos.';
            header('Location: ../Views/login.php');
        }
        exit();
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Por favor, verifica que no eres un robot.",
                        confirmButtonColor: "#023059"
                    });
                });
              </script>';
    }
}

function generarCodigo()
{
    return uniqid();
}

function SendMail($correo, $codigo)
{
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'http.diomar@gmail.com';
        $mail->Password = 'vgoiwxjqlcqvrhcx';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('http.diomar@gmail.com', 'Diomar');
        $mail->addAddress($correo);
        $dir = 'C:/xampp/htdocs/Genoma/GenomaPro/img/adn4.jpeg';
        $mail->AddEmbeddedImage($dir, 'imagen_cid', 'imagen.jpeg');

        $mail->isHTML(true);
        $mail->Subject = 'Código de ingreso.';
        $body = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Correo de Verificación de GenomaPro</title>
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
                        <h1>Verificación en Dos Pasos - GenomaPro</h1>
                    </div>
                    <p>Hola,</p>
                    <p>Has solicitado un código de verificación para acceder a tu cuenta en GenomaPro. Por favor, utiliza el siguiente código para completar el proceso de verificación:</p>
                    <div class="code">' . $codigo . '</div>
                    <p>Por favor, no compartas este código con nadie. Si no has solicitado este código, ignora este correo electrónico.</p>
                    <img src="cid:imagen_cid" alt="Imagen">
                    <p>Gracias,<br>El equipo de GenomaPro</p>
                    <div class="footer">
                        <p>&copy; 2024 GenomaPro. Todos los derechos reservados.</p>
                    </div>
                    </div>
                    </body>
                    </html>';
        $mail->Body = $body;

        $mail->send();
        echo 'Correo enviado con éxito';
    } catch (Exception $e) {
        echo "No se pudo enviar el correo. Error de Mailer: {$mail->ErrorInfo}";
    }
}
?>
