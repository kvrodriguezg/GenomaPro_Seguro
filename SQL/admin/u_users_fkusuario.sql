DROP PROCEDURE IF EXISTS u_users_fkusuario;
DELIMITER //

CREATE PROCEDURE u_users_fkusuario(
    IN u_Rut VARCHAR(10),
    OUT u_Resultado INT
)
BEGIN
    DECLARE userCount INT;

    SELECT COUNT(*) INTO userCount FROM Usuarios WHERE Rut = u_Rut;

    IF userCount > 0 THEN
        SET u_Resultado = 1;
    ELSE
        SET u_Resultado = 0;
    END IF;
END //

DELIMITER ;
