CREATE VIEW `product_overview` AS
    SELECT 
        `p`.`product_id`, 
        `p`.`product_name`, 
        `p`.`description`, 
        `p`.`quotable`, 
        `p`.`price`, 
        `p`.`quantity`, 
        `p`.`active`, 
        `p`.`approved_by`,
        `p`.`image_1`,
        `p`.`image_2`,
        `p`.`image_3`,
        `p`.`video`,
        (
            SELECT
                AVG(`rate`)
            FROM 
                `reviews` AS `r`
            INNER JOIN
                `sale_details` AS `sd`
            ON
                `r`.`product_purchase_id` = `sd`.`sale_details_id`
            WHERE
                `p`.`product_id` = `sd`.`product_id`   
        ) AS `average_rating`,
        (
            SELECT 
                SUM(`sd`.`quantity`)
            FROM 
                `sale_details` AS `sd`
            WHERE 
                `sd`.`product_id` = `p`.`product_id`
        ) AS `units_sold`
        FROM
            `products` AS `p`;

-- SELECT 
--     AVG(`rate`)
-- FROM
--     `reviews` AS `r`
-- WHERE
--     `p`.`product_id` = 
--     (
--         SELECT 
--             `product_id`
--         FROM 
--             `sale_details` AS `sd`
--         WHERE 
--             `sd`.`sale_details_id` = `r`.`product_purchase_id`
--     )    