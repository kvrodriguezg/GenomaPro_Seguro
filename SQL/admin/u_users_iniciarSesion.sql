DROP PROCEDURE IF EXISTS u_users_iniciarSesion;
DELIMITER //

CREATE PROCEDURE u_users_iniciarSesion(
    IN p_usuario VARCHAR(255)
)
BEGIN
    -- Obtener los datos del usuario
    SELECT usuario, Clave, Correo, idPerfil, IDCentroMedico
    FROM Usuarios
    WHERE usuario = p_usuario;
END //

DELIMITER ;
