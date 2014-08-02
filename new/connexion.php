<?php 
	session_start();
	include("header.php");
	
	ini_set ('session.bug_compat_42', 0); 
	ini_set ('session.bug_compat_warn', 0); 
	echo '  
    	<div class="jumbotron">
      	<div class="container">';

	$bdd = connect_database();
	// V�rification des identifiants
	$pass = md5($_POST['pass']);
	$req = $bdd->prepare('SELECT id FROM membre WHERE mail = "' .$_POST['mail']. '" AND pass = "' .$pass. '"');
	$req->execute(array(
		'mail' => $_POST['mail'],
		'pass' => $pass));

	$resultat = $req->fetch();

	// Si erreur de connexion
	if (!$resultat)
	{
		//Le membre n'existe pas , vérifions coté entreprise
		$reqEntreprise = $bdd->prepare('SELECT id FROM entreprise WHERE mail = "' .$_POST['mail']. '" AND pass = "' .$pass. '"');
		$reqEntreprise->execute(array(
		'mail' => $_POST['mail'],
		'pass' => $pass));

		$resultatEntreprise = $reqEntreprise->fetch();
		if (!$resultatEntreprise){
			//Ce n'est pas une entreprise non plus
			echo '<p>Mauvais identifiant ou mot de passe !<br/>Vous allez etre redirigé dans 3 secondes vers <strong><a href="./compte.php">Mon compte</a></strong>.</p>';
			redirect("compte.php", "3");
		}else{
			//C'est une entreprise
			$_SESSION['id'] = $resultatEntreprise['id'];
			$req = $bdd->query('SELECT * FROM entreprise WHERE id="' .$_SESSION['id']. '"');
			$myentreprise = $req->fetch();
			/*
				On rempli la session avec les informations de l'utilisateur
			*/			
			$_SESSION['mail'] = $myentreprise['mail'];
			$_SESSION['nom'] = $myentreprise['nom'];
			$_SESSION['com'] = $myentreprise['com'];
			$_SESSION['website'] = $myentreprise['website'];
			$_SESSION['nomImage'] = $myentreprise['nomImage'];
			$_SESSION['formatLogo'] = $myentreprise['formatLogo'];
			$_SESSION['type'] = "entreprise";
			redirect("compte.php", "0");
		}

		
	}
	//Si les identifiants sont exacts
	else
	{
		$_SESSION['id'] = $resultat['id'];
		
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
		if($membre['mail'] == "root@root.root"){
			$_SESSION['type'] = "root";
		}else{
			$_SESSION['type'] = "membre";
		}
		

		redirect("compte.php", "0");
		
	}
		
	echo '</div>
		</div>';
	include("footer.php") ?>
	
?>	