<?php 
/**
 * \file      envoimail.php
 * \author    Fabien Pinel
 * \version   1.0
 * \date      24 Février 2015
 * \brief     Réception du formulaire de contact ici. Insertion du msg dans la bdd et envoi du mail à l'adresse de contact.
 *
 * \details  
 */

session_start();
include("header.php");
include("variables.php");
$bdd = connect_database();
echo '  
<div class="jumbotron">
	<div class="container">';
		
		$bdd->exec( 'INSERT INTO message
			VALUES (NULL, "' .utf8_decode($_POST['nom']). '", "' .utf8_decode($_POST['prenom']). '", "'.utf8_decode($_POST['mail']). '", "' .utf8_decode($_POST['message']). '")');
		mail(''.getInfoSiteInformation("mailContact"), $_POST['prenom'].' prend contact avec Polytech Dating', $_POST['nom'].' '.$_POST['prenom'].' ----- '.$_POST['message']);
		echo '<b>L\'équipe du Polytech Dating répondra à votre requête sur votre boite mail le plus rapidement possible.</b>';
		echo '</div></div>';

		include("footer.php");
		?>