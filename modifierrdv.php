<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Polytech'Dating - Inscription</title>
	<script type="text/javascript" src="verifForm.js"></script>
	<link rel="stylesheet" href="style.css" />
	<link rel="icon" type="image/png" href="/images/icon.ico" />
</head>
<body>

	<?php include("header.php");
	try
	{
		$bdd = new PDO('mysql:host=...;dbname=...', '...', '...');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	$req = $bdd->query('	SELECT *  
							FROM rdv
							WHERE id = ' .$_POST['id']. '');
					
	$donnes = $req->fetch();

	$bdd->exec('	UPDATE heure
					SET heure.' .$donnes['heure']. ' = 1
					WHERE heure.entreprise = "' .$donnes['entreprise']. '"');
					
	$bdd->exec('	DELETE FROM rdv
					WHERE id = ' .$_POST['id']. '');
	
	echo 'Votre rendez a bien &eacute;t&eacute; supprim&eacute;';
	
	include("footer.php");
	redirect("moncompte.php", "1");
	?>

</body>
</html>