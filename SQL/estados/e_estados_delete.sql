DROP PROCEDURE IF EXISTS e_estados_delete;
DELIMITER //
CREATE PROCEDURE e_estados_delete(
    IN e_ID INT
)
BEGIN
    DELETE FROM Estados WHERE IDEstado = e_ID;
END //
DELIMITER ;

