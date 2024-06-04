DROP PROCEDURE IF EXISTS u_perfil_bPerfil;
DELIMITER //

CREATE PROCEDURE u_perfil_bPerfil(
    IN p_IDPerfil INT
)
BEGIN
    -- Buscar el tipo de perfil
    SELECT TipoPerfil FROM Perfiles WHERE IDPerfil = p_IDPerfil;
END //

DELIMITER ;
