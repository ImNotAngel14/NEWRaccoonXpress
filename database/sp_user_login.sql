DELIMITER //

CREATE PROCEDURE `sp_authLogin`
(
    IN `p_username` VARCHAR(32), 
    IN `p_user_password` VARCHAR(64)
)
BEGIN
	SELECT `user_id`, `user_role` FROM `users`
	WHERE `username` COLLATE utf8mb4_bin  = `p_username`
	AND `user_password` COLLATE utf8mb4_bin = `p_user_password`;
END;//

DELIMITER ;