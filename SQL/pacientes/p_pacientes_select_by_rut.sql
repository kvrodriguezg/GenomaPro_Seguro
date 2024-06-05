DROP PROCEDURE IF EXISTS p_pacientes_select_by_rut;
DELIMITER //
CREATE PROCEDURE p_pacientes_select_by_rut (IN rut_paciente VARCHAR(12))
BEGIN
    SELECT * FROM Pacientes WHERE RutPaciente = rut_paciente;
END //
DELIMITER ;