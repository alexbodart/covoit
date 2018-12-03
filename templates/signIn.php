
<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

?>
	<body>

	    <!-- Page Content -->
	    <div class="logsign">
		    <form class="form-signin" method="post" action="controleur.php">
		    	<h3>Inscrivez-vous içi</h3>
		    	<label for="nom">Nom</label>
		    		<input type="text" name="nom" class="form-control input" placeholder="Insérer votre nom" required autofocus>
		    	<label for="prenom">Prénom</label>
		    		<input type="text" name="prenom" class="form-control input" placeholder="Insérer votre prénom" required>
		    	<label for="email">Pseudo</label>
		    		<input type="text" name="pseudo" class="form-control input" placeholder="Insérer un pseudo" required>
		    	<label for="password">Mot de passe</label>
		    		<input type="password" name="password" class="form-control input" placeholder="Insérer un mot de passe" required>
		    		<input type="password" name="password_confirm" class="form-control input" placeholder="Confirmer le mot de passe" required>

		    	<button class="btn btn-lg btn-block" type="submit" name="action" value="signIn">S'inscire</button>
		    </form>
		</div>