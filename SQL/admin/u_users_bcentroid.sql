DROP PROCEDURE IF EXISTS u_users_bcentroid;
DELIMITER //

CREATE PROCEDURE u_users_bcentroid(
    IN u_IDCentro INT
)
BEGIN
    -- Preparar la consulta
    SELECT NombreCentro FROM CentrosMedicos WHERE  IDCentroMedico = u_IDCentro;
END //

DELIMITER ;