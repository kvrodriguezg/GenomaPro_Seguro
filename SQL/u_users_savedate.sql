DROP PROCEDURE IF EXISTS u_users_savedate;
DELIMITER //
CREATE PROCEDURE u_users_savedate(
    IN u_IDCentroMedico INT,
    IN u_IDPerfil INT,
    IN u_usuario VARCHAR(50),
    IN u_Nombre VARCHAR(50),
    IN u_Correo VARCHAR(50),
    IN u_Rut VARCHAR(10),
    IN u_Clave VARCHAR(100),
    OUT u_resultado VARCHAR(255)
)
BEGIN
    DECLARE UI_users CHAR(36);
    DECLARE userExists INT;
    DECLARE resultado VARCHAR(255);

    -- Verificar si el usuario ya existe
SELECT COUNT(*) INTO userExists FROM usuarios WHERE Rut = u_Rut;

IF userExists > 0 THEN
        -- Actualizar el usuario existente
UPDATE usuarios
SET
    usuario = u_usuario,
    Nombre = u_Nombre,
    Correo = u_Correo,
    Clave = u_Clave,
    IDPerfil = u_IDPerfil,
    IDCentroMedico = u_IDCentroMedico
WHERE Rut = u_Rut;

SET resultado = 'success';
ELSE
        -- Crear un nuevo usuario
        SET UI_users = UUID();
INSERT INTO usuarios(
    IDUsuario,
    usuario,
    Nombre,
    Correo,
    Rut,
    Clave,
    IDPerfil,
    IDCentroMedico
)
VALUES (
           UI_users,
           u_usuario,
           u_Nombre,
           u_Correo,
           u_Rut,
           u_Clave,
           u_IDPerfil,
           u_IDCentroMedico
       );

IF ROW_COUNT() > 0 THEN
            SET resultado = 'Registro Creado';
ELSE
            SET resultado = 'No se puede crear el registro';
END IF;
END IF;

    SET u_resultado = resultado;
END //
DELIMITER ;
