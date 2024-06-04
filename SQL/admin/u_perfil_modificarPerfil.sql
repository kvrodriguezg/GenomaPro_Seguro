DROP PROCEDURE IF EXISTS u_perfil_modificarPerfil;
DELIMITER //

CREATE PROCEDURE u_perfil_modificarPerfil(
    IN p_IDPerfil INT,
    IN p_TipoPerfil VARCHAR(255)
)
BEGIN
    -- Actualizar el perfil
    UPDATE Perfiles
    SET TipoPerfil = p_TipoPerfil
    WHERE IDPerfil = p_IDPerfil;
END //

DELIMITER ;
