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
          switch ($_FILES['logo']['error']){     
                   case 1: // UPLOAD_ERR_INI_SIZE     
                   echo"Le fichier dépasse la limite autorisée par le serveur !<br />"; 
                   break;     
                   case 2: // UPLOAD_ERR_FORM_SIZE     
                   echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !<br />"; 
                   break;     
                   case 3: // UPLOAD_ERR_PARTIAL     
                   echo "L'envoi du fichier a été interrompu pendant le transfert !<br />";     
                   break;     
                   case 4: // UPLOAD_ERR_NO_FILE     
                   echo "Le fichier que vous avez envoyé a une taille nulle ! <br />"; 
                   break;     
          } 
		  echo '<p>Redirection vers la page d\'inscription.</p>
		  	<br /><p>Si la redirection échoue vous pouvez cliquer <a href="./inscription.php">ici</a>.';
		  redirect("./inscription.php", "3");
		  break;    
		}     
		else {
 			// $_FILES['nom_du_fichier']['error'] vaut 0 soit UPLOAD_ERR_OK     
 			// ce qui signifie qu'il n'y a eu aucune erreur  
 			$extensions_valides = array( 'jpeg' , 'gif' , 'png' );

			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(substr(strrchr($_FILES['logo']['name'], '.')  ,1)  );
			//Vérification de la validité de l'extension
			if (in_array($extension_upload,$extensions_valides)){
				$dossier = './_/images/entreprises';
				$fichier = $_POST['nom'].$extension_upload;
				$resultat = move_uploaded_file($_FILES['logo']['tmp_name'], $dossier.$fichier);
				if ($resultat){
					//La copie s'est bien déroulée
					// Insertion dans la base de donnée
					$req = $bdd->exec('	INSERT INTO entreprise(nom, com, mail, website, formatLogo, pass)
							VALUES("' .$_POST['nom']. '", "' .$_POST['com']. '", "' .$_POST['mail']. '", "'.$_POST['website']. '", "'.$extension_upload. '", "' .md5($_POST['passEntreprise']).'")');
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