DROP PROCEDURE IF EXISTS e_examenes_select;
DELIMITER //
CREATE PROCEDURE e_examenes_select()
BEGIN
    SELECT * FROM examenes;
END //
DELIMITER ;