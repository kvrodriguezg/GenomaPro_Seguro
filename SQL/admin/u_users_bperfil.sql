DROP PROCEDURE IF EXISTS u_users_bperfil;
DELIMITER //

CREATE PROCEDURE u_users_bperfil(
    IN u_Nombreperfil VARCHAR(100)
)
BEGIN
    -- Preparar la consulta
   SELECT IDPerfil FROM perfiles WHERE TipoPerfil=u_Nombreperfil;
END //

DELIMITER ;