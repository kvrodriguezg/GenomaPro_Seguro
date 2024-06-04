DELIMITER //
DROP PROCEDURE IF EXISTS e_examenes_select_by_estado;
CREATE PROCEDURE e_examenes_select_by_estado(IN nombreEstado VARCHAR(255))
BEGIN
    SELECT *
    FROM Examenes e
    JOIN Estados es ON e.IDEstado = es.IDEstado
    WHERE es.NombreEstado = nombreEstado;
END //

DELIMITER ;