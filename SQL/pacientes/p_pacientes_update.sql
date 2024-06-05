DROP PROCEDURE IF EXISTS p_pacientes_update;
DELIMITER //
CREATE PROCEDURE p_pacientes_update(
    IN p_Nombre VARCHAR(100),
    IN p_RutNuevo VARCHAR(12),
    IN p_Domicilio VARCHAR(200),
    IN p_RutActual VARCHAR(12)
)
BEGIN
    UPDATE pacientes set NombrePaciente = p_Nombre, DomicilioPaciente = p_Domicilio, RutPaciente = p_RutNuevo WHERE RutPaciente = p_RutActual;
END //
DELIMITER ;


