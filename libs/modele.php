<?php


/*CREATE VIEW vuetrajet AS SELECT u.id as idUser, t.idTrajet, p.estConducteur, u.nom, u.prenom, t.date, t.heure, t.typeTrajet, t.sensTrajet, t.nbPlaces, t.nbPlacesActuelles FROM users as u, trajet as t, participant as p WHERE u.id = p.idUsager AND t.idTrajet = p.idTrajet;*/

// inclure ici la librairie faciliant les requêtes SQL
include_once("maLibSQL.pdo.php");

function console_log( $data, $context = 'Debug in Console' ) {

    // Buffering to solve problems frameworks, like header() in this and not a solid return.
    ob_start();

    $output  = 'console.info( \'' . $context . ':\' );';
    $output .= 'console.log(' . json_encode( $data ) . ');';
    $output  = sprintf( '<script>%s</script>', $output );

    echo $output;
}

function listerUtilisateurs($classe = "both")
{
	// NB : la présence du symbole '=' indique la valeur par défaut du paramètre s'il n'est pas fourni
	// Cette fonction liste les utilisateurs de la base de données 
	// et renvoie un tableau d'enregistrements. 
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,pseudo,blacklist,connecte,couleur

	// Lorsque la variable $classe vaut "both", elle renvoie tous les utilisateurs
	// Lorsqu'elle vaut "bl", elle ne renvoie que les utilisateurs blacklistés
	// Lorsqu'elle vaut "nbl", elle ne renvoie que les utilisateurs non blacklistés

	$SQL = "select * from users";
	if ($classe == "bl")
		$SQL .= " where blacklist=1";
	if ($classe == "nbl")
		$SQL .= " where blacklist=0";
	
	// echo $SQL;
	return parcoursRs(SQLSelect($SQL));

}
function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès
	
	//$passe=md5($passe);
	$SQL="SELECT id FROM users WHERE pseudo='$login' AND passe='$passe'";

	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}

function checkUser($pseudo)
{
	$SQL="SELECT count(*) FROM users WHERE pseudo='$pseudo'";
	return SQLGetChamp($SQL);
}

function AjouterTrajet($date,$heure,$place,$type,$sens,$conducteur)
{
		
		$SQL = "INSERT INTO `trajetinstance` (`dates`,`heure`,`type`, `sens`, `place_dispo`, `place_restante`,`conducteur_id`) VALUES ('$date','$heure','$type','$sens','$place','$place','$conducteur')";
		SQLInsert($SQL);
}

function AjouterUtilisateur($nom,$prenom,$login,$passe)
{	
		$SQL = "INSERT INTO `users` (`nom`,`prenom`,`pseudo`, `passe`) VALUES ('$nom','$prenom','$login','$passe')";
		SQLInsert($SQL); 
}

function recupTrajets()
{	
		$SQL = "SELECT * FROM listes ORDER BY dates";
		return parcoursRs(SQLSelect($SQL)); 
}

function verifPassager($id_trajet,$id_passager)
{
		$SQL = "SELECT * FROM participants WHERE passager_id='$id_passager' and trajet_id='$id_trajet'";
		return parcoursRs(SQLSelect($SQL));
}
?>
