DELIMITER $$

CREATE PROCEDURE `sp_get_user_purchases`(
    IN `buyer_id` INT,
    IN `start_date` DATE,
    IN `end_date` DATE,
    IN `category_id` INT
)
BEGIN
    SELECT 
        `s`.`sale_datetime`,
        `c`.`title` AS `category`,
        `p`.`product_name`,
        IFNULL(`r`.`rate`, 0.0) AS `rate`,
        `sd`.`individual_price` AS `Precio`
    FROM sales s
    INNER JOIN `sale_details` `sd` ON `s`.`sale_id` = `sd`.`sale_id`
    INNER JOIN `products` `p` ON `sd`.`product_id` = `p`.`product_id`
    INNER JOIN `product_categories` `pc` ON `p`.`product_id` = `pc`.`product_id`
    INNER JOIN `categories` `c` ON `pc`.`category_id` = `c`.`category_id`
    LEFT JOIN `reviews` `r` ON `sd`.`sale_details_id` = `r`.`product_purchase_id`
    WHERE `s`.`buyer_id` = `buyer_id`
      AND (`start_date` IS NULL OR DATE(`s`.`sale_datetime`) >= `start_date`)
      AND (`end_date` IS NULL OR DATE(`s`.`sale_datetime`) <= `end_date`)
      AND (`category_id` IS NULL OR `c`.`category_id` = `category_id`)
    ORDER BY `s`.`sale_datetime` DESC;
END$$

DELIMITER ;
