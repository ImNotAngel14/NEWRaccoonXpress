DELIMITER //

CREATE PROCEDURE `sp_update_product`
(
    IN `p_product_id` INT,          -- ID del producto a actualizar
    IN `p_product_name` VARCHAR(64), -- Nombre del producto
    IN `p_description` VARCHAR(160), -- Descripción del producto
    IN `p_quotable` TINYINT(1),        -- Indicador si es cotizable
    IN `p_price` DECIMAL(10, 2),    -- Precio del producto
    IN `p_quantity` INT,            -- Cantidad en inventario
    IN `p_image_1` LONGBLOB,    -- Ruta o URL de la primera imagen
    IN `p_image_2` LONGBLOB,    -- Ruta o URL de la segunda imagen
    IN `p_image_3` LONGBLOB,    -- Ruta o URL de la tercera imagen
    IN `p_video` LONGBLOB       -- Ruta o URL del video
)
BEGIN
    UPDATE `products`
    SET 
        `product_name` = `p_product_name`,
        `description` = `p_description`,
        `quotable` = `p_quotable`,
        `price` = `p_price`,
        `quantity` = `p_quantity`,
        `image_1` = CASE
            WHEN `p_image_1` IS NOT NULL THEN `p_image_1`
            ELSE `image_1`
        END,
        `image_2` = CASE 
            WHEN `p_image_2` IS NOT NULL THEN `p_image_2`
            ELSE `image_2`
        END,
        `image_3` = CASE 
            WHEN `p_image_3` IS NOT NULL THEN `p_image_3`
            ELSE `image_3`
        END,
        `video` = CASE 
            WHEN `p_video` IS NOT NULL THEN `p_video`
            ELSE `video`
        END
    WHERE 
        `product_id` = `p_product_id`;
END//

DELIMITER ;
