<?php 
	session_start();
	include("header.php");
	checkLogin();
	$bdd = connect_database();
	echo '  
    	<div class="jumbotron">
      	<div class="container">';
	
	$req = $bdd->query('	SELECT *  
							FROM rdv
							WHERE id = ' .$_POST['id']. '');
					
	$donnes = $req->fetch();

	$bdd->exec('	UPDATE heure
					SET heure.' .$donnes['heure']. ' = 0
					WHERE heure.entreprise = "' .$donnes['entreprise']. '"');
					
	$bdd->exec('	DELETE FROM rdv
					WHERE id = ' .$_POST['id']. '');
	
	echo '<p>Votre rendez-vous a bien été supprimé.</p>';
	echo '<p>Redirection...</p>';
	echo '</div></div>';
	include("footer.php");
	redirect("compte.php", "2");
?>