<?php

		// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
		if (basename($_SERVER["PHP_SELF"]) != "index.php")
		{
			header("Location:../index.php");
			die("");
		}

		// Si l'utilisateur est connecte, on affiche un lien de deconnexion 
		if (valider("connecte","SESSION"))
		{
			echo '	<div id=footer>
						<div class="container">
							<p class="text-muted credit">
								Utilisateur <b>'. $_SESSION['pseudo'] ."<span id='idUser'>" .$_SESSION['id'] .'</span></b> connecté depuis <b>'. $_SESSION['heureConnexion'] .'</b> &nbsp;
								<a href="controleur.php?action=Logout">Se Déconnecter</a>.
							</p>
						</div>
					</div>	';

		} ?>

	</body>
</html>
