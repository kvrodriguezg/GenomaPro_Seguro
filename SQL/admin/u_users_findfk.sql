DROP PROCEDURE IF EXISTS u_users_findfk;
DELIMITER //

CREATE PROCEDURE u_users_findfk(
    IN u_Rut VARCHAR(10)
)
BEGIN
    -- Preparar la consulta
    SELECT * FROM Usuarios WHERE Rut= u_Rut;
END //

DELIMITER ;