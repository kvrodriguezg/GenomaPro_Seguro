function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function validateForm() {
    var nombre = document.getElementsByName('nombre')[0];
    var rut = document.getElementsByName('rut')[0];
    var usuario = document.getElementsByName('usuario')[0];
    var clave = document.getElementsByName('clave')[0];
    var correo = document.getElementsByName('correo')[0];
    var perfil = document.getElementsByName('perfil')[0];
    var centro = document.getElementsByName('centro')[0];

    var invalidKeywords = /select|insert|update|delete|drop|alert|<script|<\/script|<|>/i;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var isValid = true;

    // Helper function to mark input invalid
    function markInvalid(input, message) {
        input.style.borderColor = "red";
        var error = document.createElement("div");
        error.className = "error-message";
        error.style.color = "red";
        error.innerHTML = message;
        if (input.nextSibling) {
            input.parentNode.insertBefore(error, input.nextSibling);
        } else {
            input.parentNode.appendChild(error);
        }
        isValid = false;
    }
    document.querySelectorAll('.error-message').forEach(e => e.remove());

    if (nombre.value === "" || invalidKeywords.test(nombre.value.toLowerCase())) {
        markInvalid(nombre, "Nombre inválido!");
    }
    if (rut.value === "" || invalidKeywords.test(rut.value.toLowerCase())) {
        markInvalid(rut, "RUT inválido!");
    }
    if (usuario.value === "" || invalidKeywords.test(usuario.value.toLowerCase())) {
        markInvalid(usuario, "Usuario inválido!");
    }
    if (clave.value === "" || invalidKeywords.test(clave.value.toLowerCase())) {
        markInvalid(clave, "Clave inválida!");
    }
    if (correo.value === "" || !emailPattern.test(correo.value) || invalidKeywords.test(correo.value.toLowerCase())) {
        markInvalid(correo, "Correo inválido!");
    }
    if (perfil.value === "" || invalidKeywords.test(perfil.value.toLowerCase())) {
        markInvalid(perfil, "Perfil inválido!");
    }
    if (centro.value === "" || invalidKeywords.test(centro.value.toLowerCase())) {
        markInvalid(centro, "Centro Médico inválido!");
    }
    return isValid;
}