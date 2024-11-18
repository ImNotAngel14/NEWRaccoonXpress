DELIMITER //

CREATE PROCEDURE `sp_shopping_cart_management`
(
    IN `p_user_id` INT,
    IN `p_product_id` INT,
    IN `p_quantity` INT,
    IN `p_operation` INT
)
BEGIN
    -- Restar
	IF `p_operation` = 0 THEN
        DELETE FROM 
            `shopping_carts`
        WHERE 
            `user_id` = `p_user_id` 
            AND `product_id` = `p_product_id` 
            AND `quantity` <= 1;
        UPDATE `shopping_carts`
        SET `quantity` = `quantity` - 1
        WHERE `user_id` = `p_user_id` AND `product_id` = `p_product_id`;
    -- Agregar
    ELSEIF `p_operation` = 1 THEN
        INSERT INTO 
            `shopping_carts` (`user_id`, `product_id`, `quantity`)
        VALUES 
            (`p_user_id`, `p_product_id`, `p_quantity`)
        ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity);
    ELSEIF `p_operation` = 2 THEN
        UPDATE `shopping_carts`
        SET `quantity` = `p_quantity`
        WHERE 
            `user_id` = `p_user_id`
            AND `product_id` = `p_product_id`;
    ELSEIF `p_operation` = 3 THEN
        DELETE FROM
            `shopping_carts`
        WHERE
            `user_id` = `p_user_id`
            AND `product_id` = `p_product_id`;
    END IF;
END;//

DELIMITER ;