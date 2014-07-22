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
			echo'<p>Vous avez d&egrave;j&aacute; cr&egrave;e votre compte. Allez sur l\'onglet <strong><a href="./compte.php">Mon compte</a></strong>.</p>';
			$existant = true;
			break;
		}
	}
	$membre->closeCursor();
	if(!$existant)
	{
		/*  Vérification des erreurs upload fichier  */
		if ($_FILES['cv']['error']) {     
          switch ($_FILES['cv']['error']){     
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
		  echo "<p>Redirection vers la page d'inscription.</p><br />";
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
				$fichier = $_POST['nom'].'-'.$_POST['prenom'].'-'.$_POST['promotion'].$extension_upload;
				$resultat = move_uploaded_file($_FILES['cv']['tmp_name'], $dossier.$fichier);
				if ($resultat){
					//La copie s'est bien déroulée
					// Insertion dans la base de donnée
					if($_POST['parcoursSI']=="" && $_POST['parcoursELEC']==""){
						$parcours=$_POST['parcoursMAM'];
					}
					else if($_POST['parcoursMAM']=="" && $_POST['parcoursSI']==""){
						$parcours=$_POST['parcoursELEC'];
					}
					else{
						$parcours=$_POST['parcoursSI'];
					}
					$req = $bdd->exec('	INSERT INTO membre(nom, prenom, mail, pass, promotion, parcours, motcles1, motcles2)
							VALUES("' .$_POST['nom']. '", "' .$_POST['prenom']. '", "' .$_POST['mail']. '", "' .md5($_POST['pass']). '", "' .$_POST['promotion'].'", "'.$parcours.'", "'.$_POST['motcles1'].'", "'.$_POST['motcles2'].'")');
					if($req){
						//L'utilisateur est bien entré dans la BDD
						echo '<p> Votre compte a bien &egrave;t&egrave; cr&egrave;e.<br/>Vous pouvez d&eacute;sormais vous y connecter via l\'onglet "Mon compte". Vous y serez redirig&eacute;(e) dans 3 secondes.</p>';
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