# Documentación
- Medidas de seguridad
- Funciones principales
  
## Función: verificarAcceso
``` function verificarAcceso($perfilesPermitidos) {
    if (!isset($_SESSION['idPerfil']) || $_SESSION['idPerfil'] !== $perfilesPermitidos) {
        error_log("Acceso no permitido para el perfil: " . $_SESSION['idPerfil']);
        header('Location: login.php');
        exit();
    }
} 
```
### Descripción
  La función verificarAcceso controla el 
  acceso a ciertas áreas de una aplicación 
  según el perfil del usuario. Verifica si el 
  perfil del usuario actual está en la lista de 
  perfiles permitidos y, si no es así, registra 
  un mensaje de error y redirige al usuario a la 
  página de inicio de sesión.
  
## Verificación en dos pasos
```
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['op']) && $_POST['op'] == "VERIFICAR") {
if (isset($_POST['codigo']) && !empty($_POST['codigo'])) {
$codigoIngresado = $_POST['codigo'];
if (isset($_SESSION['codigo_verificacion'])) {
$codigoGuardado = $_SESSION['codigo_verificacion'];
if ($codigoIngresado == $codigoGuardado) { 
//Logica de acceso
}
```
### Descripción
Después de verificar las credenciales de acceso 
el usuario debe ingresar un código generado en una 
app web, este código es validado y si coinciden
el usuario puede acceder al sistema. 

## Verificación Captcha
- LoginController:
```
if (isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['g-recaptcha-response'])) {
        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
        $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_SPECIAL_CHARS);
        $secret = $_ENV['RECAPTCHA_SECRET'];
        $response = $_POST['g-recaptcha-response'];
        $url="https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}";
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Deshabilitar la verificación SSL temporalmente (solo para pruebas)
    $response = curl_exec($ch);
```
### Descripción
Se implementó la verificación Captcha como mecanismo de seguridad 
para distinguir entre usuarios humanos y bots 
automatizados. Se agregó el Captcha para prevenir ataques automatizados.

## Protección de datos sensibles
- usuarioModel
```
$clavehash = password_hash($clave, PASSWORD_DEFAULT);
```
### Descripción
Se utilizó password_hash, como método para proteger
las contraseñas. 

## Prevención de SQL Injection
- Interacción con base de datos (Models)
```
 $query = "CALL u_users_savedate(?, ?, ?, ?, ?, ?, ?, @resultado);";
```
### Descripción
La implementación de procedimientos almacenados y la parametrización nos permite encapsular
la lógica de las consultas y prevenir la inyección de datos. 

## Protección de archivos
```
Options -Indexes
<Files ".env">
    Require all denied
</Files>
```
### Descripción

1. **Options -Indexes:**

Esta directiva desactiva la opción de listar los contenidos del directorio en el navegador web si no hay un archivo de índice (como index.html o index.php) presente. Sin esta configuración, los usuarios podrían ver una lista de todos los archivos en un directorio si no hay un archivo de índice. Esto mejora la seguridad al evitar que los usuarios puedan explorar los contenidos del directorio.
2. **<Files ".env"> Require all denied:**

Esta directiva específica se aplica a un archivo llamado .env. El archivo .env a menudo contiene información sensible como configuraciones de la aplicación y credenciales de la base de datos.
Require all denied bloquea completamente el acceso a este archivo desde el navegador web, asegurando que no se pueda visualizar ni descargar.
### Propósito General
El propósito de este archivo .htaccess es mejorar la seguridad del sitio web al:

- Prevenir el listado de directorios, lo que podría exponer la estructura y los archivos del sitio.
- Bloquear el acceso a archivos sensibles como .env, protegiendo así la información confidencial contenida en ellos.

# Fuente 
Para el propósito de este proyecto y como fuente de información
sobre vulnerabilidades y medidas implementadas para proteger el sistema,
se utilizó la lista Top Ten publicada por Owasp.
[Owasp Top Ten](https://owasp.org/www-project-top-ten/)