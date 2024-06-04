DROP PROCEDURE IF EXISTS u_users_bcentro;
DELIMITER //

CREATE PROCEDURE u_users_bcentro(
    IN u_Centro VARCHAR(100)
)
BEGIN
    -- Preparar la consulta
    SELECT IDCentroMedico FROM CentrosMedicos WHERE NombreCentro=u_Centro;
END //

DELIMITER ;