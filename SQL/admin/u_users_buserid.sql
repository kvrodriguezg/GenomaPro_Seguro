DROP PROCEDURE IF EXISTS u_users_buserid;
DELIMITER //

CREATE PROCEDURE u_users_buserid(
    IN u_IDPerfil INT
)
BEGIN
    -- Preparar la consulta
    SELECT * FROM Usuarios where IDUsuario = u_IDPerfil;
END //

DELIMITER ;