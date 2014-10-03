<?php 
	session_start();
	include("header.php");
	echo '<div class="jumbotron">
    		<div class="container">';

	$bdd = connect_database();
	$membre = $bdd->query('SELECT * FROM membre');
	$existant = false;
	while($donnees = $membre->fetch())
	{
		if($donnees['mail'] == $_POST['mail'])
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
		if ($_FILES['cv']['error']) {  
		  echo '<div class="alert alert-danger" role="alert">';   
          switch ($_FILES['cv']['error']){     
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
 			$extensions_valides = array('pdf');

			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(substr(strrchr($_FILES['cv']['name'], '.')  ,1)  );
			//Vérification de la validité de l'extension
			if (in_array($extension_upload,$extensions_valides)){
				$dossier = './_/cv/';
				$fichier = $_POST['nom'].'-'.$_POST['prenom'].'-'.$_POST['promotion'].'.'.$extension_upload;
				chmod($dossier, 0755);
				$resultat = move_uploaded_file($_FILES['cv']['tmp_name'], $dossier.$fichier);
				chmod($dossier.$fichier, 0644);
				if ($resultat){
					//La copie s'est bien déroulée
					// Insertion dans la base de donnée
					$req = $bdd->exec('	INSERT INTO membre(nom, prenom, mail, pass, promotion, parcours, motcles1, motcles2)
							VALUES("' .$_POST['nom']. '", "' .$_POST['prenom']. '", "' .$_POST['mail']. '", "' .md5($_POST['passEtudiant']). '", "' .$_POST['promotion'].'", "'.$_POST['parcours'].'", "'.$_POST['motcles1'].'", "'.$_POST['motcles2'].'")');
					if($req){
						//L'utilisateur est bien entré dans la BDD
						echo '<p> Votre compte a bien été crée.<br/>Vous pouvez désormais vous y connecter via l\'onglet "<a href="./compte.php">Mon compte</a>". Vous y serez redirigé(e) dans 3 secondes.</p>';
						redirect("./compte.php", "3");
					}
					else{
						//La requete a échouée
						echo "<p>La création de votre compte a échouée. Veuillez recommencer.</p>";
						redirect("inscription.php", "2");
					}

				}
					
			}else{
				echo "<p>Extension invalide. Votre fichier doit être en .pdf.</p>";
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