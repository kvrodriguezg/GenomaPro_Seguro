DROP PROCEDURE IF EXISTS u_users_bperfilid;
DELIMITER //

CREATE PROCEDURE u_users_bperfilid(
    IN u_IDPerfil INT
)
BEGIN
    -- Preparar la consulta
    SELECT TipoPerfil FROM Perfiles WHERE IDPerfil = u_IDPerfil;
END //

DELIMITER ;