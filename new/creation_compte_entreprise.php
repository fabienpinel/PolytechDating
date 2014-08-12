<?php 
	session_start();
	include("header.php");
	echo '<div class="jumbotron">
    		<div class="container">';

	$bdd = connect_database();
	$membre = $bdd->query('SELECT * FROM entreprise');
	$existant = false;
	while($donnees = $membre->fetch())
	{
		if(($donnees['mail'] == $_POST['mail']) ||  ($donnees['nom']== $_POST['nom']))
		{
			echo'<p>Vous avez déjà crée votre compte. Allez dans l\'onglet <strong><a href="./compte.php">Mon compte</a></strong>.</p>';
			$existant = true;
			break;
		}
	}
	$membre->closeCursor();
	if(!$existant)
	{
		/*  Vérification des erreurs upload fichier  */
		if ($_FILES['logo']['error']) {   
		  echo '<div class="alert alert-danger" role="alert">';
          switch ($_FILES['logo']['error']){     
                   case 1: // UPLOAD_ERR_INI_SIZE     
                   echo '<div class="alert alert-danger" role="alert">Le fichier dépasse la limite autorisée par le serveur !</div>'; 
                   break;     
                   case 2: // UPLOAD_ERR_FORM_SIZE     
                   echo '<div class="alert alert-danger" role="alert">Le fichier dépasse la limite autorisée dans le formulaire HTML !</div>'; 
                   break;     
                   case 3: // UPLOAD_ERR_PARTIAL     
                   echo '<div class="alert alert-danger" role="alert">L\'envoi du fichier a été interrompu pendant le transfert !</div>';     
                   break;     
                   case 4: // UPLOAD_ERR_NO_FILE     
                   echo '<div class="alert alert-danger" role="alert">Le fichier que vous avez envoyé a une taille nulle ! </div>'; 
                   break;  
          } 
		  echo '<p>Redirection vers la page d\'inscription.</p>
		  	<br /><p>Si la redirection échoue vous pouvez cliquer <a href="./inscription.php">ici</a>.';
		  	echo '</div>';
		  redirect("./inscription.php", "3");
		  break;    
		}     
		else {
 			// $_FILES['nom_du_fichier']['error'] vaut 0 soit UPLOAD_ERR_OK     
 			// ce qui signifie qu'il n'y a eu aucune erreur  
 			$extensions_valides = array( 'jpeg' , 'gif' , 'png', 'jpg' );

			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(substr(strrchr($_FILES['logo']['name'], '.')  ,1)  );
			//Vérification de la validité de l'extension
			if (in_array($extension_upload,$extensions_valides)){
				$dossier = './_/images/entreprises/';
				$fichier = $_POST['nom'].'.'.$extension_upload;
				$resultat = move_uploaded_file($_FILES['logo']['tmp_name'], $dossier.$fichier);
				if ($resultat){
					//La copie s'est bien déroulée
					// Insertion dans la base de donnée
					$req = $bdd->exec('	INSERT INTO entreprise(nom, com, mail, website, nomImage, formatLogo, pass)
							VALUES("' .$_POST['nom']. '", "' .$_POST['com']. '", "' .$_POST['mail']. '", "'.$_POST['website']. '","' .$_POST['nom']. '", "'.$extension_upload. '", "' .md5($_POST['passEntreprise']).'")');
					if($req){
						//L'utilisateur est bien entré dans la BDD
						//Il faut maintenant créer la ligne de rendez vous qui lui est consacrée dans la bdd
						$rendezvous = $bdd->exec('INSERT INTO heure(entreprise, 14h00, 14h20, 14h40, 15h00, 15h20, 15h40, 16h00, 16h20, 16h40, 17h00) VALUES((select id from entreprise where mail ="'.$_POST['mail'].'" AND nom="' .$_POST['nom']. '" AND website= "'.$_POST['website'].'"), 0,0,0,0,0,1,0,0,0,0)');
						if($rendezvous){
							echo '<p> Votre compte a bien été crée.<br/>Vous pouvez désormais vous y connecter via l\'onglet "<a href="./compte.php">Mon compte</a>". Vous y serez redirigé(e) dans 3 secondes.</p>';
							redirect("./compte.php", "3");
						}else{
							//La requete rdv a échouée
							echo "<p>La création de votre compte a réussie cependant il y a eu un problème concernant une autre requête. Veuillez contacter l'administration du site (cf page contact).</p>";
						}
					}
					else{
						//La requete a échouée
						echo "<p>La création de votre compte a échouée. Veuillez recommencer.</p>";
						redirect("inscription.php", "2");
					}

				}
					
			}else{
				echo "<p>Extension invalide. Votre fichier doit être une image.</p>";
				redirect("inscription.php", "2");
				break;
				
			}
		} 
		
	}
	
	?>
	
	<?php 
	echo '</div>
		</div>';
		include("footer.php"); 

	?>