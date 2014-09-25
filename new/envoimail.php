<?php 
	session_start();
 	include("header.php");
	include("variables.php");
	$bdd = connect_database();
	echo '  
    	<div class="jumbotron">
      	<div class="container">';
	
	$bdd->exec( 'INSERT INTO message
				VALUES (NULL, "' .utf8_decode($_POST['nom']). '", "' .utf8_decode($_POST['prenom']). '", "'.utf8_decode($_POST['mail']). '", "' .utf8_decode($_POST['message']). '")');
	mail('polytech.dating@gmail.com', $_POST['prenom'].' prend contact avec Polytech Dating', $_POST['nom'].' '.$_POST['prenom'].' ----- '.$_POST['message']);
	echo '<b>L\'équipe du Polytech Dating répondra à votre requête sur votre boite mail le plus rapidement possible.</b>';
	echo '</div></div>';

	include("footer.php");
	 ?>