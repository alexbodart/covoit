<?php

	// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
	if (basename($_SERVER["PHP_SELF"]) != "index.php")
	{
		header("Location:../index.php?view=login");
		die("");
	}

	// Chargement eventuel des données en cookies
	$login = valider("login", "COOKIE");
	$passe = valider("passe", "COOKIE"); 
	if ($checked = valider("remember", "COOKIE"))
	{
		$checked = "checked"; 
	}

	if(valider("error","GET"))
	{
		echo '	<div  id="wrongPass">
					<div class="alert alert-danger">
						<strong>Attention !</strong> Identifiants incorrects.
					</div>
				</div>	';
	}

	if(valider("success","GET"))
	{
		echo '	<div  id="wrongPass">
					<div class="alert alert-success">
						<strong>Super !</strong> Compte créé avec succès.
					</div>
				</div>	';
	}

?>

	<p class="lead">

	<div id="logSign">
		<form role="form" action="controleur.php" id="modifyLogIn" class="formulaire">
			<img class="Avatar" src="./ressources/Avatar.jpg" alt="" width="72" height="72">
			<h3>Formulaire de Connexion</h3>
			<div class="form-group">
				<label for="email">Login</label>
				<input required autofocus type="text" class="form-control" id="email" name="login" value="<?php echo $login;?>" >
			</div>
			<div class="form-group">
				<label for="pwd">Passe</label>
				<input required type="password" class="form-control" id="pwd" name="passe" value="<?php echo $passe;?>">
			</div>
			<div class="checkbox">
				<label><input type="checkbox" name="remember" <?php echo $checked;?> >Se souvenir de moi</label>
			</div>
			<button type="submit" name="action" value="Connexion" class="btn btn-primary">Connexion</button>
		</form>
	</div>

	</p>








