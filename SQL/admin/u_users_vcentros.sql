DROP PROCEDURE IF EXISTS u_users_vcentros;
DELIMITER //

CREATE PROCEDURE u_users_vcentros()
BEGIN
    SELECT NombreCentro FROM CentrosMedicos;
END //

DELIMITER ;
