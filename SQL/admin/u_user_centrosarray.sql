DROP PROCEDURE IF EXISTS u_users_centrosarray;
DELIMITER //

CREATE PROCEDURE u_users_centrosarray()
BEGIN
    -- Preparar la consulta
    SELECT NombreCentro FROM CentrosMedicos;
END //

DELIMITER ;
