<?php 
	session_start();
	include("header.php");
	
	ini_set ('session.bug_compat_42', 0); 
	ini_set ('session.bug_compat_warn', 0); 

	$bdd = connect_database();
	// V�rification des identifiants
	$pass = md5($_POST['password']);
	$req = $bdd->prepare('SELECT id FROM membre WHERE mail = "' .$_POST['mail']. '" AND pass = "' .md5($_POST['pass']). '"');
	$req->execute(array(
		'mail' => $_POST['mail'],
		'pass' => $pass));

	$resultat = $req->fetch();

	// Si erreur de connexion
	if (!$resultat)
	{
		echo 'Mauvais identifiant ou mot de passe !<br/>Vous allez etre redirige dans 3 secondes vers <strong>Mon compte</strong>.';
		redirect("compte.php", "3");
	}
	//Si les identifiants sont exacts
	else
	{
		$_SESSION['id'] = $resultat['id'];
		//
		$req = $bdd->query('SELECT * FROM membre WHERE id="' .$_SESSION['id']. '"');
		$membre = $req->fetch();
		//
		$req2 = $bdd->query('SELECT entreprise, heure FROM rdv
							WHERE membre=' .$_SESSION['id']. '');
		$entreprise = $req2->fetch();
		
		/*
			On rempli la session avec les informations de l'utilisateur
		*/			
		$_SESSION['mail'] = $membre['mail'];
		$_SESSION['nom'] = $membre['nom'];
		$_SESSION['prenom'] = $membre['prenom'];
		$_SESSION['promotion'] = $membre['promotion'];
		$_SESSION['parcours'] = $membre['parcours'];
		$_SESSION['entreprise'] = $entreprise['entreprise'];
		$_SESSION['heure'] = $entreprise['heure'];
	
		echo'
		<form method="post" action="compte.php">
			<input type="hidden" name="mail" value="' .$_POST['mail']. '"/>
			<input type="hidden" name="pass" value="' .$_POST['pass']. '"/>
		</form>';
	}
		
	echo '<script language="Javascript">
		document.location.replace("compte.php");
	</script>';
	include("footer.php") ?>
	
?>	