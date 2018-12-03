<?php

	if (basename($_SERVER["PHP_SELF"]) != "index.php")
	{
		header("Location:../index.php?view=accueil");
		die("");
	}

	if(valider("succes","GET"))
	{
	    echo '	<div>
	    			<div class="alert alert-success">
	    				<strong>Succes !</strong> Ajout effectué.
	    			</div>
	    		</div> ';
	}
?>

		<div class="container" id="box">
			<form method='POST' action="controleur.php">
				<h3>Ajout d'un trajet</h3>
				<h4>Date</h4>
					<div>
						<input class="form-control no-spin" type="date" id="dates" name="dates" required autofocus>
					</div>
					<div>
						<input class="form-control no-spin" type="time" id="heure" name="heure" required>
					</div>
				<h4 class="bottom-space top-space">Sens du trajet</h4>
					<div>
						<div>
							<input id="lille" name="sens" type="radio" value="1" checked required>
							<label for="lille">Lille &rarr; Lens</label>
						</div>
						<div>
							<input id="lens" name="sens" type="radio" value="2" required>
							<label for="lens">Lens &rarr; Lille</label>
						</div>
					</div>
				<h4 class="bottom-space top-space">Type de trajet</h4>
					<div>
						<div>
							<input id="aller" name="type" value="1" type="radio" checked required>
							<label for="aller">Aller</label>
						</div>
						<div>
							<input id="allerRetour" name="type" value="2" type="radio" required>
							<label for="allerRetour">Aller-Retour</label>
						</div>					
					</div>
				<h4>Nombre de place disponible</h4>  
					<div>
						<input class="form-control" type="number" id="place" name="place" required min=1 max=7>
					</div>
				<button class="btn btn-lg btn-block" type="submit" name="action" value="tripAdd">Ajouter mon trajet</button>
			</form>
		</div>