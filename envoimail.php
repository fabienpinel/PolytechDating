<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Polytech'Dating</title>
	<link rel="stylesheet" href="style.css" />
	<link rel="icon" type="image/png" href="/images/icon.ico" />
</head>
<body>

	<?php include("header.php") ?>
	
	<?php
	try
	{
		$bdd = new PDO('mysql:host=...;dbname=...', '...', '...');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	$bdd->exec( 'INSERT INTO message
				VALUES (NULL, "' .$_POST['nom']. '", "' .$_POST['prenom']. '", "' .$_POST['promotion']. '", "' .$_POST['mail']. '@polytech.unice.fr", "' .$_POST['message']. '")');
	echo 'L\'&eacute;quipe du Polytech Dating r&eacute;pondra &agrave; votre requete sur votre boite mail le plus rapidement possible.';
	include("footer.php") ?>

</body>
</html>