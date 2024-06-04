DROP PROCEDURE IF EXISTS u_users_crearPerfiles;
DELIMITER //

CREATE PROCEDURE u_users_crearPerfiles()
BEGIN
    INSERT INTO Perfiles (TipoPerfil) VALUES
                                          ('Administrador'),('Recepcionista'),('Tecnico Tincion'),
                                          ('Tecnico Diagnostico'),('Tecnico Registro'),('Centro medico');
END //

DELIMITER ;
