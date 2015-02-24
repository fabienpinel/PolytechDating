<?php 
/**
 * \file      entreprises.php
 * \author    Fabien Pinel
 * \version   1.0
 * \date      24 Février 2015
 * \brief     Affichage de la liste d'entreprises activée avec leur logo et lien vers le site.
 *
 * \details  
 */

session_start(); 
$encours="entreprises";
include("header.php");
?>
<div class="jumbotron">
	<div class="container">
		<div id="entreprises">
			<div id="listentreprises">
				<!-- Affichage entreprise -->
				<?php
				$bdd = connect_database();
				$entreprise = $bdd->query('SELECT * FROM entreprise');
				$retour=0;
				while($donnees = $entreprise->fetch())
				{
					if($donnees['active'] == true) {
						?>
						<div class="OneEntreprise">
							<a target="_blanck" href="<?php echo $donnees['website'] ?>">
								<img src="./_/images/entreprises/<?php echo $donnees['nomImage'].'.'.$donnees['formatLogo'];?>" /></a>
								<p><?php echo $donnees['nom'] ?></p>
							</div>
							<?php
							
							
						}
					} 
					?>
				</div>

			</div>
		</div>
	</div>
	<?php include("footer.php") ?>