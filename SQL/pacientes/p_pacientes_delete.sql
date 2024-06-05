DROP PROCEDURE IF EXISTS p_pacientes_delete;
DELIMITER //
CREATE PROCEDURE p_pacientes_delete(
    IN p_Rut VARCHAR(12)
)
BEGIN
    DELETE FROM pacientes WHERE RutPaciente = p_Rut;
END //
DELIMITER ;

