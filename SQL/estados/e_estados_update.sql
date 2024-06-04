DROP PROCEDURE IF EXISTS e_estados_update;
DELIMITER //
CREATE PROCEDURE e_estados_update(
    IN e_NombreEstado VARCHAR(255),
    IN e_IDPerfil INT,
    IN e_idEstado INT
)
BEGIN
    UPDATE Estados set NombreEstado = e_NombreEstado, IDPerfil = e_IDPerfil WHERE IDEstado = e_idEstado;
END //
DELIMITER ;

