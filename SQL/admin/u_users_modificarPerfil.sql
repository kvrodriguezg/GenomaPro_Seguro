DROP PROCEDURE IF EXISTS u_users_modificarPerfil;
DELIMITER //
CREATE PROCEDURE u_users_modificarPerfil(
    IN p_usuario VARCHAR(255),
    IN p_nombre VARCHAR(255),
    IN p_correo VARCHAR(255),
    IN p_rut VARCHAR(255),
    IN p_clave VARCHAR(255),
    IN p_idperfil INT,
    IN p_idcentro INT,
    IN p_idusuario INT
)
BEGIN
    UPDATE Usuarios
    SET usuario = p_usuario,
        Nombre = p_nombre,
        Correo = p_correo,
        Rut = p_rut,
        Clave = p_clave,
        IDPerfil = p_idperfil,
        IDCentroMedico = p_idcentro
    WHERE IDUsuario = p_idusuario;
END //
DELIMITER ;
