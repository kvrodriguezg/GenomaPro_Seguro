DROP PROCEDURE IF EXISTS p_pacientes_select;
DELIMITER //
CREATE PROCEDURE p_pacientes_select()
BEGIN
    SELECT * FROM pacientes;
END //
DELIMITER ;