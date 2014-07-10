<?php 
	session_start();
	include("header.php");
	try
	{
		$bdd = new PDO('mysql:host=...;dbname=...', '...', '...');
		
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	if (isset($_SESSION['id']) AND isset($_SESSION['mail']))
	{
		$req = $bdd->query('SELECT * FROM membre WHERE id="' .$_SESSION['id']. '"');
		$membre = $req->fetch();
		
		if($membre['promotion'] == 'IFI')
		{
			$rendezVous = $bdd->query(	'SELECT heure.16h00, heure.16h15, heure.16h30, heure.16h45, heure.17h00, heure.17h15, heure.17h30, heure.17h45
										FROM heure
										INNER JOIN entreprise
											ON heure.entreprise = entreprise.id
										WHERE entreprise.nom = "' .$_POST['choix']. '"');
										
			$donnes = $rendezVous->fetch();
			echo'<p>Voici les horaires auquels ' .$_POST['choix']. ' sera disponible.<br/>Choisissez un cr&eacute;neau de passage.</p>';
			echo
			'<form method="post" action="validation.php">
				<p>';
			$heures = array('16h00', '16h15', '16h30', '16h45', '17h00', '17h15', '17h30', '17h45', '18h00');
			for($i = 0;$i < 8;$i++)
			{
				if($donnes[$heures[$i]])
					echo '<input type="radio" name="heure" value="' .$heures[$i]. '" id="' .$heures[$i]. '"  /> <label for="' .$heures[$i]. '"> ' .$heures[$i]. ' &agrave; '.$heures[$i+1]. '</label><br/>';
			}
			echo 
					'<input type="hidden" name="entreprise" value="' .$_POST['choix']. '"/>
					<input type="submit" value= "Envoyer" /><br/>
				</p>
			</form>';
			echo'<p>Retour vers la <a href="moncompte.php">liste des entreprises.</a></p>';
			$rendezVous->closeCursor();
		}
		else
		{
			$rendezVous = $bdd->query(	'SELECT heure.14h00, heure.14h20, heure.14h40, heure.15h00, heure.15h20, heure.16h00, heure.16h20, heure.16h40, heure.17h00
										FROM heure
										INNER JOIN entreprise
											ON heure.entreprise = entreprise.id
										WHERE entreprise.nom = "' .$_POST['choix']. '"');
										
			$donnes = $rendezVous->fetch();
			echo'<p>Voici les horaires auquels ' .$_POST['choix']. ' sera disponible &agrave; vous accueillir.<br/>Choisissez un cr&eacute;neau de passage.</p>';
			echo
			'<form method="post" action="validation.php">
				<p>';
			$heures = array('14h00', '14h20', '14h40', '15h00', '15h20', '15h40', '16h00', '16h20', '16h40', '17h00', '17h20');
			for($i = 0;$i < 16;$i++)
			{
				if($donnes[$heures[$i]])
					echo '<input type="radio" name="heure" value="' .$heures[$i]. '" id="' .$heures[$i]. '"  /> <label for="' .$heures[$i]. '">De ' .$heures[$i]. ' &agrave; '.$heures[$i+1]. '</label><br/>';
			}
			echo 
					'<input type="hidden" name="entreprise" value="' .$_POST['choix']. '"/>
					<input type="submit" value= "Envoyer" /><br/>
				</p>
			</form>';
			$rendezVous->closeCursor();
		}
	}
	include("footer.php");
	?>
</body>
</html>