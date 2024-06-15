<?php
function sanitizeArray($data) {
    $sanitizedData = array();
    foreach ($data as $key => $value) {
        if (is_string($value)) {
            $sanitizedValue = htmlentities(trim(strip_tags(stripslashes($value))), ENT_NOQUOTES, "UTF-8");
        } else {
            $sanitizedValue = $value;
        }
        $sanitizedData[$key] = $sanitizedValue;
    }
    return $sanitizedData;
}

function alerta($message) {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "' . $message . '",
                confirmButtonColor: "#023059"
            }).then(function() {
                window.location.href = window.location.href; // Redirige a la misma página
            });
        });
      </script>';
}

function validateData($data) {
    $invalidKeywords = "/select|insert|update|delete|drop|alert|<script|<\/script|<|>/i";
    $emailPattern = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";

    if (empty($data['nombre']) || preg_match($invalidKeywords, $data['nombre'])) {
        return false;
    }
    if (empty($data['rut']) || preg_match($invalidKeywords, $data['rut'])) {
        return false;
    }
    if (empty($data['usuario']) || preg_match($invalidKeywords, $data['usuario'])) {
        return false;
    }
    if (empty($data['clave']) || preg_match($invalidKeywords, $data['clave'])) {
        return false;
    }
    if (empty($data['correo']) || !preg_match($emailPattern, $data['correo']) || preg_match($invalidKeywords, $data['correo'])) {
        return false;
    }
    if (empty($data['perfil']) || preg_match($invalidKeywords, $data['perfil'])) {
        return false;
    }
    if (empty($data['centro']) || preg_match($invalidKeywords, $data['centro'])) {
        return false;
    }

    return true;  // No errors
}
?>
