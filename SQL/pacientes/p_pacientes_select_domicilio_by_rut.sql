DROP PROCEDURE IF EXISTS p_pacientes_select_domicilio_by_rut;
DELIMITER //
CREATE PROCEDURE p_pacientes_select_domicilio_by_rut (IN rut_paciente VARCHAR(12))
BEGIN
    SELECT DomicilioPaciente FROM Pacientes WHERE RutPaciente = rut_paciente;
END //
DELIMITER ;