<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Polytech'Dating</title>
	<link rel="stylesheet" href="style.css" />
	<link rel="icon" type="image/png" href="/images/icon.ico />
</head>
<body>

	<?php include("header.php");
							
	echo '<p>Vous avez rendez vous avec ' .$_POST['entreprise'] . ' &agrave; ' .$_POST['heure']. '</p>';
	
	try
	{
		$bdd = new PDO('mysql:host=...;dbname=...', '...', '...');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	$bdd->exec(	'UPDATE heure
				INNER JOIN entreprise
					ON heure.entreprise = entreprise.id
				SET heure.' .$_POST['heure']. ' = 0
				WHERE entreprise.nom = "' .$_POST['entreprise']. '"');
							
	
	$entreprise = $bdd->query('	SELECT id FROM entreprise
								WHERE nom="' .$_POST['entreprise']. '"');
	$donnesEntreprise = $entreprise->fetch();				
	
	$bdd->exec('	INSERT INTO rdv
					VALUES (NULL, ' .$donnesEntreprise['id']. ', ' .$_SESSION['id']. ', "' .$_POST['heure']. '")');
	redirect("moncompte.php",1);
	
	?>
	<?php include("footer.php") ?>

</body>
</html>