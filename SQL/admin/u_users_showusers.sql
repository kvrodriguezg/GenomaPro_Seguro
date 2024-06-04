DROP PROCEDURE IF EXISTS u_users_allusers;
DELIMITER //

CREATE PROCEDURE u_users_allusers()
BEGIN
    -- Ejecutar la consulta para seleccionar todos los usuarios
    SELECT * FROM usuarios;
END //

DELIMITER ;
