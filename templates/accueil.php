<?php

	if (basename($_SERVER["PHP_SELF"]) != "index.php")
	{
		header("Location:../index.php?view=accueil");
		die("");
	}

?>

	<body id="acc">
		Page d'acceuil
	</body>