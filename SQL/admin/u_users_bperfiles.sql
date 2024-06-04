DROP PROCEDURE IF EXISTS u_users_bperfiles;
DELIMITER //

CREATE PROCEDURE u_users_bperfiles(
)
BEGIN
    -- Preparar la consulta
    SELECT * FROM perfiles;
END //

DELIMITER ;
