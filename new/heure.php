<?php 
	session_start();
	include("header.php");
	$encours="heure"; 
	echo '<div class="jumbotron">
    		<div class="container">';
	$bdd = connect_database();
	checkLogin();

	$req = $bdd->query('SELECT * FROM membre WHERE id="' .$_SESSION['id']. '"');
	$membre = $req->fetch();
	$rendezVous = $bdd->query('SELECT heure.14h00, heure.14h20, heure.14h40, heure.15h00, heure.15h20, heure.15h40, heure.16h00, heure.16h20, heure.16h40, heure.17h00
										FROM heure
										INNER JOIN entreprise
											ON heure.entreprise = entreprise.id
										WHERE entreprise.nom = "' .$_POST['choix']. '"');
										
	$donnes = $rendezVous->fetch();
	echo'<p>Voici les horaires auquels <b>' .$_POST['choix']. '</b> sera disponible pour vous accueillir.<br/>Choisissez un cr&eacute;neau de passage.</p>';
	echo'<form data-toggle="validator" method="post" action="validation.php" role="form" class="form-horizontal">';
	$heures = array('14h00', '14h20', '14h40', '15h00', '15h20','15h40', '16h00', '16h20', '16h40', '17h00', '17h20');
	for($i = 0;$i < 10;$i++){
			if(!$donnes[$heures[$i]]){
				echo '<div class="radio">
  					<label>
    				<input type="radio" name ="heure" value="' .$heures[$i]. '" id="' .$heures[$i]. '" required>
    					De ' .$heures[$i]. ' &agrave; '.$heures[$i+1]. '
  					</label>
				</div>';
				
			}
				
	}
	echo '<input type="hidden" name="entreprise" value="' .$_POST['choix']. '"/>
		<input type="submit" value= "Valider" class="btn btn-primary" />
			
			 </form>';
	$rendezVous->closeCursor();

	echo '</div></div>';
	include("footer.php");
?>