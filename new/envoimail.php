<?php 
	session_start();
 	include("header.php");

	$bdd = connect_database();
	
	$bdd->exec( 'INSERT INTO message
				VALUES (NULL, "' .$_POST['nom']. '", "' .$_POST['prenom']. '", "' .$_POST['promotion']. '", "' .$_POST['mail']. '@polytech.unice.fr", "' .$_POST['message']. '")');
	echo 'L\'&eacute;quipe du Polytech Dating r&eacute;pondra &agrave; votre requete sur votre boite mail le plus rapidement possible.';
	include("footer.php") ?>

</body>
</html>