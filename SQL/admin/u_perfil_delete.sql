DROP PROCEDURE IF EXISTS u_perfil_delete;
DELIMITER //

CREATE PROCEDURE u_perfil_delete(
    IN u_ID INT
)
BEGIN
    -- Preparar la consulta
    DELETE FROM perfiles WHERE IDPerfil=u_ID;
END //

DELIMITER ;