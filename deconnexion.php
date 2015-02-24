<?php 
/**
 * \file      deconnexion.php
 * \author    Fabien Pinel
 * \version   1.0
 * \date      24 Février 2015
 * \brief     Déconnexion de l'utilisateur.
 *			  Suppression des informations de SESSION et des cookies.
 *
 * \details  
 */

session_start();

if (isset($_SESSION['id']) AND isset($_SESSION['mail']))
{
		// Suppression des variables de session et de la session
	$_SESSION = array();
	session_destroy();

		// Suppression des cookies de connexion automatique
	setcookie('mail', '');
	setcookie('pass', '');
}

echo '<script language="Javascript">
document.location.replace("./compte.php");
</script>';
?>
