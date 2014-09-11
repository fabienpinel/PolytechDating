<?php 
	session_start(); 
	$encours="entreprises";
	include("header.php");
?>
	 <div class="jumbotron">
      <div class="container">
		<div id="entreprises">
			<table>
				<tr>
					<!-- Affichage entreprise -->
					<?php
							$bdd = connect_database();
							$entreprise = $bdd->query('SELECT * FROM entreprise');
							$retour=0;
							while($donnees = $entreprise->fetch())
							{
								if($donnees['active'] == true) {
										$retour = $retour + 1; 
										?>
										<td>
										<a target="_blanck" href="<?php echo $donnees['website'] ?>">
										<img src="./_/images/entreprises/<?php echo $donnees['nomImage'].'.'.$donnees['formatLogo'];?>" /></a>
										<p><?php echo $donnees['nom'] ?></p>
										</td>
							<?php
								 
									if($retour > 3){
										echo '</tr><tr>';
										$retour = 0;
									}
								}
							} 
					?>
				</tr>
			</table>

		</div>
	</div>
	</div>
	<?php include("footer.php") ?>