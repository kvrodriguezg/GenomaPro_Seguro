DROP PROCEDURE IF EXISTS u_perfil_vertipoPerfiles;
DELIMITER //

CREATE PROCEDURE u_perfil_vertipoPerfiles()
BEGIN
    -- Obtener los tipos de perfil
    SELECT TipoPerfil FROM Perfiles;
END //

DELIMITER ;
