<?php
$sql="CREATE DEFINER=`root`@`localhost` FUNCTION `nbTrajetPassagers`(id_utilisateur int) RETURNS int(11)
BEGIN
DECLARE nbr int;
SET nbr=0;
SELECT COUNT(*) INTO nbr FROM  participants WHERE (id_utilisateur=passager_id);
RETURN nbr;
END";

SQLinsert($sql)
?>