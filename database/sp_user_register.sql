DELIMITER //

CREATE PROCEDURE `sp_register`
(
    IN `p_email` VARCHAR(64),
    IN `p_username` VARCHAR(32),
    IN `p_user_password` VARCHAR(64),
    IN `p_user_role` TINYINT(1),
    IN `p_first_name` VARCHAR(64),
    IN `p_last_name` VARCHAR(64),
    IN `p_gender` TINYINT(1),
    IN `p_birth_date` DATE
)
BEGIN
	INSERT INTO `users` (
        `email`,
        `username`,
        `user_password`, 
        `user_role`, 
        `first_name`, 
        `last_name`, 
        `gender`, 
        `birth_date`
    ) 
    VALUES (
        `p_email`,
        `p_username`,
        `p_user_password`,
        `p_user_role`,
        `p_first_name`,
        `p_last_name`,
        `p_gender`,
        `p_birth_date`
    );
END;//

DELIMITER ;