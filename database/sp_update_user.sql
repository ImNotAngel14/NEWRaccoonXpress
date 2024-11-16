DELIMITER //

CREATE PROCEDURE `sp_update_user`
(
    IN `p_user_id` INT,
    IN `p_username` VARCHAR(32),
    IN `p_email` VARCHAR(64),
    IN `p_user_password` VARCHAR(64),
    IN `p_first_name` VARCHAR(64),
    IN `p_last_name` VARCHAR(64),
    IN `p_birth_date` DATE,
    IN `p_gender` TINYINT(1),
    IN `p_visibility` TINYINT(1),
    IN `p_profile_image` BLOB
)
BEGIN
	UPDATE `users` SET
    `username` = `p_username`,
    `email` = `p_email`,
    `user_password` = `p_user_password`,
    `first_name` = `p_first_name`,
    `last_name` = `p_last_name`,
    `birth_date` = `p_birth_date`,
    `gender` = `p_gender`,
    `visibility` = `p_visibility`,
    `profile_image` = CASE 
            WHEN `p_profile_image` IS NOT NULL THEN `p_profile_image`
            ELSE `profile_image`
        END
    WHERE `user_id` = `p_user_id`;
END;//

DELIMITER ;