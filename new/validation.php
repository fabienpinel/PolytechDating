<?php 
session_start();
include("header.php");
checkLogin();
echo'<div class="jumbotron">
<div class="container">';						
	
	
	$bdd = connect_database();
	
	$bdd->exec(	'UPDATE heure
		INNER JOIN entreprise
		ON heure.entreprise = entreprise.id
		SET heure.' .$_POST['heure']. ' = 1
		WHERE entreprise.nom = "' .$_POST['entreprise']. '"');
	
	
	$entreprise = $bdd->query('	SELECT id FROM entreprise
		WHERE nom="' .$_POST['entreprise']. '"');
	$donnesEntreprise = $entreprise->fetch();				
	
	$bdd->exec('	INSERT INTO rdv
		VALUES (NULL, ' .$donnesEntreprise['id']. ', ' .$_SESSION['id']. ', "' .$_POST['heure']. '")');
	//envoi mail de confirmation
	mail(''.$_SESSION['mail'], 'Confirmation rendez-vous Polytech Dating', 'Bonjour '.$_SESSION['prenom'].' '.$_SESSION['nom'].', vous avez pris rendez-vous avec '.$_POST['entreprise'].' à '.$_POST['heure'].'.');
	echo '<p>Vous avez rendez vous avec ' .$_POST['entreprise'] . ' &agrave; ' .$_POST['heure']. '.</p>';
	echo '<p>Redirection...</p>';
	redirect("compte.php",2);
	echo '</div></div>';
	include("footer.php");

	?>