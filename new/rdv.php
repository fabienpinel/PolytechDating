<?php 
	session_start();
	include("header.php");
	$encours="rdv"; 
	checkLogin();
	
	$bdd = connect_database();
	echo'<div class="jumbotron">
      	<div class="container">';
	
		echo  '<p>'.$_SESSION['nom']. ' ' .$_SESSION['prenom']. ', étant en  ' .$_SESSION['promotion']. ', l\'&eacute;quipe du Polytech Dating vous offre la possibilit&eacute; de choisir un rendez-vous parmi ces entreprises.</p>';
		
		/*if($_SESSION['promotion']=="SI5" || $_SESSION['promotion']=="IFI"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="SI" ORDER BY nom');
			
		}else if($_SESSION['promotion']=="ELEC5"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="ELEC" ORDER BY nom');
		}else if($_SESSION['promotion']=="M2 IMAFA"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="IMAFA" ORDER BY nom');
		}else if($_SESSION['promotion']=="MAM5"){
			if($_SESSION['parcours']=="IMAFA"){
				$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="IMAFA" ORDER BY nom');
			}
			else{
				$entreprise = $bdd->query('SELECT * FROM entreprise ORDER BY nom');
			}
		}else{
			$entreprise = $bdd->query('SELECT * FROM entreprise ORDER BY nom');
		}*/
		$entreprise = $bdd->query('SELECT * FROM entreprise WHERE active=TRUE ORDER BY nom');
		echo '<p>
				Voici la liste des entreprises que nous avons sélectionnées pour vous.
				<br/>Veuillez choisir celle avec laquelle vous souhaiteriez avoir un entretien :</p>';
		echo '<form data-toggle="validator" method="post" action="heure.php" class="form-horizontal formulaireRDV" >';
		while($donnes = $entreprise->fetch()){
			if(entrepriseEncoreDisponible($donnes['id'])){
				echo '<div class="radio">
  					<label>
    				<input type="radio" name="choix" value="' .$donnes['nom']. '" id="' .$donnes['nom']. '" required>
    					' .$donnes['nom']. '
  					</label>
				</div>';
			}
		}
		
		echo'<input class="submit btn btn-primary" name="send" type="submit" value="Valider" />';
		echo '<a href="./compte.php" ><button type="button" style="margin-left: 2px;" class="btn btn-warning">Retour à mon compte</button></a>';
		echo '</p></form>';
	echo '</div></div>';
	include("footer.php") ?>