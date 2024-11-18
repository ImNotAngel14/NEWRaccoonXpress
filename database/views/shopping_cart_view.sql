CREATE VIEW `shopping_cart_view` AS
    SELECT 
        `sc`.`quantity` AS `cart_quantity`, 
        `sc`.`product_id`, 
        `sc`.`user_id`,
        `p`.`product_name`,
        `p`.`price`,
        `p`.`quantity` AS `product_quantity`,
        `p`.`image_1`
    FROM 
        `shopping_carts` AS `sc`
    INNER JOIN
        `products` AS `p`
        ON `sc`.`product_id` = `p`.`product_id`;