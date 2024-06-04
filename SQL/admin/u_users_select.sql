DROP PROCEDURE IF EXISTS universal_select;
DELIMITER //

CREATE PROCEDURE universal_select(
    IN select_query TEXT
)
BEGIN
    -- Preparar la consulta
    SET @query = select_query;

    -- Ejecutar la consulta
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER ;
