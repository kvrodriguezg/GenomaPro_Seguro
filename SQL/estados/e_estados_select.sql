DROP PROCEDURE IF EXISTS e_estados_select;
DELIMITER //
CREATE PROCEDURE e_estados_select()
BEGIN
    SELECT * from Estados;
END //
DELIMITER ;