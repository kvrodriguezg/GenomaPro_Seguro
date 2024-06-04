DROP PROCEDURE IF EXISTS u_users_delete;
DELIMITER //

CREATE PROCEDURE u_users_delete(
    IN u_ID INT
)
BEGIN
    -- Preparar la consulta
    DELETE FROM usuarios WHERE IDUsuario=u_ID;
END //

DELIMITER ;