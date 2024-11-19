DELIMITER $$

CREATE PROCEDURE `sp_sales_report`(
    IN `p_fecha_inicio` DATETIME,
    IN `p_fecha_fin` DATETIME,
    IN `p_categoria` INT
)
BEGIN
    -- Consulta detallada
    SELECT 
        `s`.`sale_datetime` AS `sale_datetime`,
        `c`.`title` AS `category`,
        `p`.`product_name` AS `product`,
        IFNULL(`r`.`rate`, 0.0) AS `rating`,
        `sd`.`individual_price` AS `price`,
        `p`.`quantity` AS `inventory`
    FROM `sales` `s`
    INNER JOIN `sale_details` `sd` ON `s`.`sale_id` = `sd`.`sale_id`
    INNER JOIN `products` `p` ON `sd`.`product_id` = `p`.`product_id`
    INNER JOIN `product_categories` `pc` ON `p`.`product_id` = `pc`.`product_id`
    INNER JOIN `categories` `c` ON `pc`.`category_id` = `c`.`category_id`
    LEFT JOIN `reviews` `r` ON `sd`.`sale_details_id` = `r`.`product_purchase_id`
    WHERE 
        (`p_fecha_inicio` IS NULL OR DATE(`s`.`sale_datetime`) >= `p_fecha_inicio`)
        AND (`p_fecha_fin` IS NULL OR DATE(`s`.`sale_datetime`) <= `p_fecha_fin`)
        AND (`p_categoria` IS NULL OR `c`.`category_id` = `p_categoria`)
    ORDER BY `s`.`sale_datetime`;
END$$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE `sp_sales_report_grouped`(
    IN `p_fecha_inicio` DATETIME,
    IN `p_fecha_fin` DATETIME,
    IN `p_categoria` INT
)
BEGIN
    -- Consulta agrupada
    SELECT 
        DATE_FORMAT(`s`.`sale_datetime`, '%Y-%m') AS `month_year`,
        `c`.`title` AS `category`,
        COUNT(*) AS `total_sales`
    FROM `sales` `s`
    INNER JOIN `sale_details` `sd` ON `s`.`sale_id` = `sd`.`sale_id`
    INNER JOIN `products` `p` ON `sd`.`product_id` = `p`.`product_id`
    INNER JOIN `product_categories` `pc` ON `p`.`product_id` = `pc`.`product_id`
    INNER JOIN `categories` `c` ON `pc`.`category_id` = `c`.`category_id`
    WHERE 
        (`p_fecha_inicio` IS NULL OR DATE(`s`.`sale_datetime`) >= `p_fecha_inicio`)
        AND (`p_fecha_fin` IS NULL OR DATE(`s`.`sale_datetime`) <= `p_fecha_fin`)
        AND (`p_categoria` IS NULL OR `c`.`category_id` = `p_categoria`)
    GROUP BY `month_year`, `c`.`title`
    ORDER BY `month_year`, `c`.`title`;
END$$

DELIMITER ;
