<?php 
	session_start();
	include("header.php");
							
	echo '<p>Vous avez rendez vous avec ' .$_POST['entreprise'] . ' &agrave; ' .$_POST['heure']. '</p>';
	
	$bdd = connect_database();
	
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