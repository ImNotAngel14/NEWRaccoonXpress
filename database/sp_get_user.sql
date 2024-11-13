DELIMITER //

CREATE PROCEDURE `sp_get_user`
(
    IN `p_user_id` INT,
    IN `p_is_owner` TINYINT(1)
)
BEGIN
    SELECT 
        `username`, 
        `profile_image`, 
        `user_role`, 
        `visibility`,
        IF(`p_is_owner`, `user_password`, NULL) AS `user_password`,
        IF(`p_is_owner`, `first_name`, NULL) AS `first_name`,
        IF(`p_is_owner`, `last_name`, NULL) AS `last_name`,
        IF(`p_is_owner`, `gender`, NULL) AS `gender`,
        IF(`p_is_owner`, `birth_date`, NULL) AS `birth_date`,
        IF(`p_is_owner`, `email`, NULL) AS `email`
    FROM 
        `users`
    WHERE
        `user_id` = `p_user_id`;
END;//

DELIMITER ;