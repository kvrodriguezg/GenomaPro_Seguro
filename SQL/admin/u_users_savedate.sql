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
    DECLARE userExists INT;
    DECLARE resultado VARCHAR(255);

    -- Verificar si el usuario ya existe
    SELECT COUNT(*) INTO userExists FROM usuarios WHERE Rut = u_Rut;

    IF userExists = 0 THEN
        -- Crear un nuevo usuario
        INSERT INTO usuarios(
            usuario,
            Nombre,
            Correo,
            Rut,
            Clave,
            IDPerfil,
            IDCentroMedico
        )
        VALUES (
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
    ELSE
        SET resultado = 'El usuario ya existe';
    END IF;

    SET u_resultado = resultado;
END //

DELIMITER ;
