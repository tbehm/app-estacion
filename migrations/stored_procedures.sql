-- Retorna una lista con todos los usuarios activos


DELIMITER $$
CREATE DEFINER=`losapuntes`@`%` PROCEDURE `getCantUser`()
SELECT * FROM losapuntes__usuarios WHERE delete_at = '0000-00-00 00:00:00'$$
DELIMITER ;