DROP PROCEDURE IF EXISTS e_estados_insert;
DELIMITER //
CREATE PROCEDURE e_estados_insert(
    IN e_NombreEstado VARCHAR(255),
    IN e_IDPerfil INT
)
BEGIN
    INSERT INTO Estados (NombreEstado, IDPerfil) VALUES (e_NombreEstado, e_IDPerfil);
END //
DELIMITER ;

