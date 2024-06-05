DROP PROCEDURE IF EXISTS p_pacientes_insert;
DELIMITER //
CREATE PROCEDURE p_pacientes_insert(
    IN p_RutPaciente VARCHAR(12),
    IN p_NombrePaciente VARCHAR(100),
    IN p_DomicilioPaciente VARCHAR(200)
)
BEGIN
    INSERT INTO pacientes (RutPaciente, NombrePaciente, DomicilioPaciente) VALUES (p_RutPaciente, p_NombrePaciente, p_DomicilioPaciente);
END //
DELIMITER ;

