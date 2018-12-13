<?php

	if (basename($_SERVER["PHP_SELF"]) != "index.php")
	{
		header("Location:../index.php?view=accueil");
		die("");
	}

?>

	<div id="tripList">
		    
		<h3> Liste des trajets </h3>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">N° Trajet</th>
						<th scope="col">Date</th>
						<th scope="col">Heure de départ</th>
						<th scope="col">Lieu de départ</th>
						<th scope="col">Type</th>
						<th scope="col">Conducteur</th>
						<th scope="col">Place dispo</th>
						<th scope="col">Place restante</th>
						<th scope="col">S'inscrire</th>
						<th scope="col">Se désinscrire</th>
						<th scope="col">Supprimer</th>
						<th scope="col">Plus d'info</th>
					</tr>
				</thead>
				<tbody>

				<?php
					$liste=recupTrajets();
					$compteur = 0;
					foreach ($liste as $trajet)
					{
							echo '	<tr id=row'. $compteur .'>
										<th scope="row">'. $trajet['id'] .'</th>
										<td>'. $trajet['dates'] .'</td>
										<td>'. $trajet['heure'] .'</td>	';

							if($trajet['sens']==1)
							{
								echo '	<td>Centrale Lille</td>	';
							}
							else
							{
								echo '	<td>IG2I</td>	';
							}
							if($trajet['type']==1)
							{
								echo '	<td>Aller</td>	';
							}
							else
							{
								echo '	<td>A/R</td>	';
							}

								echo '	<td>'. $trajet['nom'] .' '. $trajet['prenom'] .'</td>
										<td>'. $trajet['place_dispo'] .'</td>
										<td>'. $trajet['place_restante'] .'</td>	';


	

							if ($trajet['nom'] == $_SESSION['nom'] && $trajet['prenom'] == $_SESSION['prenom'])
							{
								echo '	<td></td>
										<td></td>
										<td>
											<a href="#" onclick="Suppression()">
												<img src="./ressources/poubelle.png" alt="icone poubelle" height="20" width="20">
											</a>
										</td>	';
							}
							else 	
							{
								if ((verifPassager($trajet['id'],$_SESSION['id'])) != null)
								{
									echo '	<td></td>
											<td>
												<a href="#" onclick="Désincription()">
													<img src="./ressources/moins.png" alt="icone désincription" height="20" width="20">
												</a>
											</td>
											<td></td>	';
								}
								else if ($trajet['place_restante'] > 0)
								{
									echo '	<td>
												<a href="#" onclick="Inscription()">
													<img src="./ressources/plus.png" alt="icone inscription" height="20" width="40">
												</a>
											</td>
											<td></td>
											<td></td>	';
								}
								else
								{
									echo '	<td></td>
											<td></td>
											<td></td>	';
								}
							}

							echo '	<td>
										<span class="glyphicon glyphicon-search plusDetails" id="'. $compteur .'"></a>
									</td>
								</tr>	';

						$compteur++;
					}

				?>
				</tbody>
			</table>
	</div>