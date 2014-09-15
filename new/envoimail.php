<?php 
	session_start();
 	include("header.php");
	include("variables.php");
	$bdd = connect_database();
	echo '  
    	<div class="jumbotron">
      	<div class="container">';
	
	$bdd->exec( 'INSERT INTO message
				VALUES (NULL, "' .$_POST['nom']. '", "' .$_POST['prenom']. '", "'.$_POST['mail']. '", "' .$_POST['message']. '")');
	mail('pinel.fabien@gmail.com', $_POST['prenom'].' prend contact avec Polytech Dating', $_POST['nom'].' '.$_POST['prenom'].'<br />'.$_POST['message']);
	echo '<b>L\'équipe du Polytech Dating répondra à votre requete sur votre boite mail le plus rapidement possible.</b>';
	echo '</div></div>';

	include("footer.php");
	 ?>