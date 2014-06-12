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

	<?php include("header.php");
	
		try
		{
			$bdd = new PDO('mysql:host=...;dbname=...', '...', '...');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}

	
		echo  $_SESSION['nom']. ' ' .$_SESSION['prenom']. ', &eacute;tant en  ' .$_SESSION['promotion']. ', l\'&eacute;quipe du Polytech Dating vous propose la possibilit&eacute; de choisir un rendez-vous parmi ces entreprises.</p>';
		
		if($_SESSION['promotion']=="SI5" || $_SESSION['promotion']=="IFI"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="SI" ORDER BY nom');
			
		}else if($_SESSION['promotion']=="ELEC5"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="ELEC" ORDER BY nom');
		}else if($_SESSION['promotion']=="M2 IMAFA"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="IMAFA" ORDER BY nom');
		}else if($_SESSION['promotion']=="MAM5"){
			if($_SESSION['parcours']=="IMAFA"){
				$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="IMAFA" ORDER BY nom');
			}
			else{
				$entreprise = $bdd->query('SELECT * FROM entreprise ORDER BY nom');
			}
		}else{
			$entreprise = $bdd->query('SELECT * FROM entreprise ORDER BY nom');
		}
		
		echo 
		'<form method="post" action="heure.php">
			<p>
				Voici la liste des entreprises que nous avons s&eacute;l&eacute;ctionn&eacutees; pour vous.<br/>Veuillez choisir celle avec laquelle vous souhaiteriez avoir un entretien :<br/>';	
		
		while($donnes = $entreprise->fetch())
			echo'	<input type="radio" name="choix" value="' .$donnes['nom']. '" id="' .$donnes['nom']. '"/>
					<label for="' .$donnes['nom']. '">' .$donnes['nom']. '</label><br/>';
			
		echo'	<input class="submit" name="send" type="submit" value="Envoyer" />
			</p>
		</form>';
		
	include("footer.php") ?>

</body>
</html>