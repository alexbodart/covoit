<?php

	include("./libs/modele.php");

	// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
	if (basename($_SERVER["PHP_SELF"]) != "index.php")
	{
		header("Location:../index.php");
		die("");
	}

	// Pose qq soucis avec certains serveurs...
	echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";

?>

<!DOCTYPE html>
<html lang="fr">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Covoiturage Lille - Lens</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- Bootstrap JS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<!-- JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Personnal CSS -->
		<link rel="stylesheet" type="text/css" href="./css/default.css">

		<!-- Personnal JS -->
		<script src="./js/traitment.js"></script>

		<!-- Personnal JQuery -->	
		<script src="./js/JQuery.js"></script>

	</head>

	<body>

		<div id="wrap">
  
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php?view=acceuil">
						<p><span class="glyphicon glyphicon-home"></span>&emsp;Ride With Centrale</p>
						</a>
					</div>
					<ul class="nav navbar-nav navbar-left">

						<?php 	if (valider("connecte","SESSION"))
								{
									echo '	<li class="nav-item"><a href="index.php?view=tripAdd">Ajouter un trajet</a></li>
											<li class="nav-item"><a href="index.php?view=tripList">Liste des trajets</a></li>	';
								}
						?>

					</ul>
					<ul class="nav navbar-nav navbar-right">

						<?php 	if (!valider("connecte","SESSION"))
								{
									echo '	<li class="nav-item"><a href="index.php?view=signIn">S\'inscrire</a></li>
											<li class="nav-item"><a href="index.php?view=logIn">Se connecter</a></li>	';
								}
						
								if (valider("connecte","SESSION"))
								{
									echo '	<li class="nav-item"><a href="controleur.php?action=Logout">Se déconnecter</a></li>
											
											<li class="dropdown active">
												<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>&emsp;
													'. $_SESSION['pseudo'] .'&emsp; <span class="caret"></span>
												</a>
												<ul class="dropdown-menu">
													<ul class="nav nav-pills nav-stacked">
														<li><a href="#">Nombre de covoiturages réalisés : &emsp;&emsp;<span id="nbTrajetConducteur"></span></a></li>
														<li><a href="#">Nombre de voyages réalisés : &emsp;&emsp;&emsp;&emsp;<span id="nbTrajetPassager"></span></a></li>
														<li><a href="#">Nombre de passagers transportés : &emsp;<span id="nbPassagersTransportes"></span></a></li>
													</ul>
												</ul>
											</li>	';
								}
						?>
					</ul>
				</div>
			</nav>

<div class="container">  <!-- Begin page content -->
