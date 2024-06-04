DROP PROCEDURE IF EXISTS e_estados_select_by_id;
DELIMITER //
CREATE PROCEDURE e_estados_select_by_id(
    IN e_ID INT
)
BEGIN
    SELECT * FROM estados WHERE IDEstado = e_ID;
END //
DELIMITER ;

