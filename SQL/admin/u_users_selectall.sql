DROP PROCEDURE IF EXISTS u_users_selectall;
DELIMITER //

CREATE PROCEDURE u_users_selectall(
)
BEGIN
    -- Preparar la consulta
    SELECT * FROM centrosmedicos;
END //

DELIMITER ;
