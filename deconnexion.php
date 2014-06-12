<?php 
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
	document.location.replace("moncompte.php");
	</script>';
?>
