DELIMITER //

CREATE PROCEDURE `sp_product_search`
(
    IN `p_search` VARCHAR(64),
    IN `p_min_price` DECIMAL,
    IN `p_max_price` DECIMAL, 
    IN `p_filter_order` INT
)
BEGIN
    SELECT 
        `product_id`, `product_name`, `price`, `quotable`, `average_rating`, `units_sold`, `image_1`, `image_2`, `image_3`, `video`
    FROM 
        `product_overview`
    WHERE
        `product_name` LIKE CONCAT('%', p_search, '%')
    ORDER BY
        CASE
            WHEN `p_filter_order` = 1 THEN `average_rating` END DESC,
        CASE
            WHEN `p_filter_order` = 2 THEN `price`END DESC,
        CASE
            WHEN `p_filter_order` = 3 THEN `price` END ASC,
        CASE
            WHEN `p_filter_order` = 4 THEN `units_sold` END DESC,
        CASE
            WHEN `p_filter_order` = 5 THEN `units_sold` END ASC;
END;//

DELIMITER ;