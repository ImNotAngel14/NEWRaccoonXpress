DELIMITER //

CREATE PROCEDURE `sp_deactivate_user`
(
    IN `p_user_id` INT
)
BEGIN
	UPDATE `users` SET
    `active` = 0
    WHERE `user_id` = `p_user_id`;
END;//

DELIMITER ;