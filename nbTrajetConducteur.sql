CREATE DEFINER=`root`@`localhost` FUNCTION `nbTrajetConducteur`(id_utilisateur int) RETURNS int(11)
BEGIN
DECLARE nbr int;
SET nbr=0;
SELECT COUNT(*) INTO nbr FROM  trajetinstance WHERE (id_utilisateur=conducteur_id);
RETURN nbr;
END