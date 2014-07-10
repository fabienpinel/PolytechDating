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