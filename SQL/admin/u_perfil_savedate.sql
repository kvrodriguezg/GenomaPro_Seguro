DROP PROCEDURE IF EXISTS u_perfil_savedate;
DELIMITER //
CREATE PROCEDURE u_perfil_savedate(
    IN u_TipoPerfil VARCHAR(50)
)
BEGIN
    DECLARE perfilExists INT;
SELECT COUNT(*) INTO perfilExists FROM perfiles WHERE TipoPerfil = u_TipoPerfil;

IF perfilExists > 0 THEN
UPDATE perfiles
SET
    TipoPerfil = u_TipoPerfil
WHERE TipoPerfil = u_TipoPerfil;

ELSE
INSERT INTO perfiles(
    TipoPerfil
)
VALUES (
          u_TipoPerfil
       );

END IF;

END //
DELIMITER ;
