<?php 
	session_start(); 
	$encours="compte";
	include("header.php");
	include("variables.php");
	$bdd = connect_database();
	echo '  
    	<div class="jumbotron">
      	<div class="container">';

    /*	Prise en compte des codes retours */
    if(isset($_GET['code'])){
    	switch($_GET['code']){
    		case 0:
    			//Tout s'est bien passé
    			echo ' <div class="alert alert-success" role="alert">La modification du compte s\'est terminée avec succès.</div>';
    			break;
    		case 1:
    			//Il y a eu des erreurs
    			echo ' <div class="alert alert-danger" role="alert">La modification du compte ne s\'est pas bien terminée. Veuillez recommencer.</div>';
    			break;
    	}
    }

    /* Traitement du formumlaire de changememt d'état si présent */
    if(isset($_POST['idEntreprise']) && isset($_POST['activation'])){
    	if($_POST['activation']){
    		$resultat = $bdd->exec('UPDATE entreprise SET active = FALSE WHERE id = "'.$_POST['idEntreprise'].'"');
    	}else{
    		$resultat = $bdd->exec('UPDATE entreprise SET active = TRUE WHERE id = "'.$_POST['idEntreprise'].'"');
    	}
    	
    	if($resultat){
    		echo '<div class="alert alert-success" role="alert">Le changement d\'état de l\'entreprise s\'est terminée avec succès.</div>';
    	}else{
    		echo '<div class="alert alert-danger" role="alert">Le changement d\'état de l\'entreprise ne s\'est pas bien terminée.</div>';	
    	}
    }

	/*
	*	Si les identifiants sont corrects
	*/
	if (isset($_SESSION['id']) AND isset($_SESSION['mail']))
	{
		// Si compte root
		if($_SESSION['type'] == 'root')
		{
			/*
				A REVOIR !!!
				TODO
			*/

			/* LISTE DES ETUDIANTS INSCRITS */
			echo'<h2 class="titleetudiants">Liste des étudiants inscrits <button class="btn btn-default" onClick="reduire(etudiants);"><span class="glyphicon glyphicon-chevron-down" id="down" style="display:none;" ></span><span class="glyphicon glyphicon-chevron-up" id="up" ></span></button></h2>';
			$req = $bdd->query('SELECT * from membre WHERE mail<>"root@root.root"');
			echo'<table class="table table-hover" id="etudiants">';
			echo '<th>Nom</th><th>Prénom</th><th>Mail</th><th>Promotion</th><th>Parcours</th><th>Mot clés 1</th><th>Mot clés 2</th><th>CV</th>';
			while($etu = $req->fetch()){
				echo'<tr>';
				echo '<td>' .$etu['nom']. '</td><td>' .$etu['prenom']. '</td>';
				echo '<td>' .$etu['mail']. '</td><td>' .$etu['promotion']. '</td>';
				echo '<td>' .$etu['parcours']. '</td><td>' .$etu['motcles1']. '</td>';
				echo '<td>' .$etu['motcles2']. '</td><td><a href="./_/cv/'.$etu['nom'].'-'.$etu['prenom'].'-'.$etu['promotion'].'.pdf">Voir le CV</a></td>';
				echo '</tr>';
			}
			echo'</table>';







			/*  LISTE DES RDV */ 
			echo'<h2 class="titlerdvEtudiants">Liste des rendez-vous pris par les étudiants <button class="btn btn-default" onClick="reduire(rdvEtudiants);"><span class="glyphicon glyphicon-chevron-down" id="down" style="display:none;" ></span><span class="glyphicon glyphicon-chevron-up" id="up" ></span></button></h2>';
			/*SELECT membre.nom, membre.prenom, membre.promotion, membre.parcours,  membre.motcles1, membre.motcles2 AS membre, heure AS rdv, entreprise.nom AS entreprise
									FROM rdv
									INNER JOIN entreprise
										ON entreprise.id = rdv.entreprise
									INNER JOIN membre
										ON membre.id = rdv.membre
									ORDER BY entreprise.nom, rdv.heure
									*/
			$req = $bdd->query('	SELECT membre.nom, membre.prenom, membre.promotion AS membre, heure AS rdv, entreprise.nom AS entreprise
									FROM rdv
									INNER JOIN entreprise
										ON entreprise.id = rdv.entreprise
									INNER JOIN membre
										ON membre.id = rdv.membre
									ORDER BY entreprise.nom, rdv.heure');
			
			echo'<table class="table table-hover rdvEtudiants" id="rdvEtudiants">';
			while($rdv = $req->fetch())
				echo'<tr><td>' .$rdv['nom']. '</td><td>' .$rdv['prenom']. '</td><td>' .$rdv['membre']. '</td><td>' .$rdv['entreprise']. '</td><td>' .$rdv['rdv']. '</td></tr>';
			echo'</table>';
				




			/* LISTE DES MESSAGES */
			echo'<h2 id="titlemessages">Messages laissés grâce au formulaire de contact <button class="btn btn-default" onClick="reduire(messages);"><span class="glyphicon glyphicon-chevron-down" id="down" style="display:none;" ></span><span class="glyphicon glyphicon-chevron-up" id="up" ></span></button></h2>';
			echo '<div id="messages">';
			$req = $bdd->query('SELECT * FROM message');
			
			while($message = $req->fetch())
				echo'<p>' .$message['nom']. ' ' .$message['prenom']. ' en ' .$message['membre']. ' a laiss&eacute; un message.<br/>
						E-mail : ' .$message['mail']. '<br/>
						"' .$message['texte']. '"
					</p>';	

			echo '</div>';

			/* LISTE DES ENTREPRISES */
			echo '<h2 class="titlelistingEntreprise">Liste des entreprises inscrites <button class="btn btn-default" onClick="reduire(listingEntreprise);"><span class="glyphicon glyphicon-chevron-down" id="down" style="display:none;" ></span><span class="glyphicon glyphicon-chevron-up" id="up" ></span></button></h2>';
			echo '<p>Une fois l\'entreprise validée, elle apparaît dans le listing des entreprises sur la page "entreprises" avec son logo et elle est accessible dans la prise de rendez vous pour les étudiants.</p>';
			//lister la table entreprise
			$requeteEntreprise = $bdd->query('SELECT * FROM entreprise');
			echo '<table id="listingEntreprise" class="table table-hover">';
			echo '<th>Nom</th><th>Mail</th><th>Spécialité visée</th><th>Site</th><th>Compte validé</th><th></th>';
			while($uneEntreprise = $requeteEntreprise->fetch()){
				//afficher l'etat de chaque entreprise
				?>
				<tr <?php if($uneEntreprise['active']){ echo 'class="entrepriseValidee"';}  ?>>
				<?php
				echo '<td>';
				echo ''.$uneEntreprise['nom'];
				echo '</td><td>';
				echo ''.$uneEntreprise['mail'];
				echo '</td><td>';
				echo ''.$uneEntreprise['com'];
				echo '</td><td>';
				echo '<a href="'.$uneEntreprise['website'].'" target="_blanck">'.$uneEntreprise['website'].'</a>';
				echo '</td><td>';

				?> 
				<input type="checkbox" class="checkbox" style="margin-left: 20px;" <?php if($uneEntreprise['active']){echo'checked';} ?> disabled>
				<?php
				echo '</td><td>';
				echo '<form action="compte.php" method="POST">
					<input type="hidden" name="idEntreprise" id="idEntreprise" value="'.$uneEntreprise['id'].'" />
					<input type="hidden" name="activation" id="activation" value="'.$uneEntreprise['active'].'" />';
				if($uneEntreprise['active']){
					echo'<button type="submit" class="btn btn-danger">Désactiver</button>';
				}else{
					echo '<button type="submit" class="btn btn-success">Valider</button>';
					
				}
				
				echo '</form></td></tr>';
			}
			echo '</table>';




		}
		// Si compte user
		else if($_SESSION['type'] == 'membre')
		{
				$req = $bdd->query('	SELECT entreprise.nom AS entreprise, rdv.heure AS heure
										FROM rdv
										INNER JOIN entreprise
											ON entreprise.id = rdv.entreprise
										INNER JOIN membre
											ON membre.id = rdv.membre
										WHERE membre.id=' .$_SESSION['id']. '');
										
				$donnes = $req->fetch();
				// Si aucune prise de rendez vous
				if(!isset($donnes['entreprise']) || !isset($donnes['heure']))
				{
					echo'	<p>Vous n\'avez pas encore pris(e) de rendez-vous.</p>
							<p> Afin de prendre un nouveau rendez-vous, cliquez <a href="rdv.php">ici</a>.</p>';		
				}
				// Si prise de rendez vous
				else
				{
					//echo'<p>Attention ! À partir du 2 Décembre, les rendez-vous ne seront plus modifiables.</p>';
					$req = $bdd->query('	SELECT entreprise.nom AS entreprise, rdv.heure AS heure, rdv.id AS id
											FROM rdv
											INNER JOIN entreprise
												ON entreprise.id = rdv.entreprise
											INNER JOIN membre
												ON membre.id = rdv.membre
											WHERE membre.id=' .$_SESSION['id']. '');
											
					$i=0;
					while($donnes = $req->fetch()){
							echo '	<div class="alert alert-info" role="info">
									<form method="post" action="modifierrdv.php">
										<p>Vous avez rendez-vous avec ' .$donnes['entreprise']. ' &agrave; ' .$donnes['heure']. '
										<br/>Pour le supprimer et en choisir un autre parmis ceux encore disponible, cliquez sur <strong>Supprimer</strong>.
										<input type="hidden" name="id" value="' .$donnes['id']. '"/>
										<input name="send" type="submit" value="Supprimer" class="btn btn-danger" />
									</form>
									</div>';
									$i++;
				
					}
					//cf variables.php pour changer la  variable.
					if($i>=$nombreRDVParPersonne){
						echo '<div class="alert alert-danger" role="alert">Vous ne pouvez plus prendre de rendez-vous, ils sont limités à 1/personne pour le moment.</div>';
					}
					else{
						echo'	<p> Afin de prendre un nouveau rendez-vous, cliquez <a href="rdv.php">ici</a>.</p>';	
					}
				}
				?>
				<div class="boutonsCompte">
					<a class="btn btn-warning" href="./modification_cpte.php"  role="button">Modifier mon compte</a>
				</div>

		<?php
		}
		else if($_SESSION['type'] == 'entreprise')
		{
			?>
			<div class="compteEntreprise">
				<div class="entrepriseLayout">
					<img src="./_/images/entreprises/<?php echo $_SESSION['nomImage'].'.'.$_SESSION['formatLogo'];?>" />
					<div id="resume">
						<p>Bonjour <?php echo $_SESSION['nom']; ?> !</p>
						<p><?php echo $_SESSION['mail']; ?></p>
					</div>
				</div>
				<div class="boutonsCompte">
					<a class="btn btn-warning" href="./modification_cpte.php"  role="button">Modifier mon compte</a>
				</div>
			</div>

			<?php
		}
	}
	else
	{
		echo '<div id="compte">
		<h3>Cette rubrique va vous permettre de gérer vos rendez-vous.</h3>
		
		<form class="form-signin" role="form" action="connexion.php" method="post">
        <h2 class="form-signin-heading">Connectez vous</h2>
        <input type="text" class="form-control" placeholder="Email" name="mail" id="mail" required="" autofocus="">
        <input type="password" class="form-control" name="pass" id="pass" placeholder="Mot de passe" required="">
        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
        <a href="./inscription.php"><button class="btn btn-lg btn-success btn-block" type="button" style="margin-top: 1px;">Inscription</button></a>
      </form>

		</div>';
	}

	echo '</div></div>';
	?>
	<script>
		//Cacher les div de la page root au chargement pour plus de lisibilité
		window.onload = function() {
			reduire('#messages')
			reduire('#listingEntreprise');
			reduire('#rdvEtudiants');
			reduire('#etudiants');
		}

		function reduire(divi){
			if ($(divi).is(':visible')) {
				$(divi).parent().children('.glyphicon-chevron-up').hide();
				$(divi).parent().children('.glyphicon-chevron-down').show();
				//$('#down').fadeIn(200, null);
				//$('#up').fadeOut(200, null);
				//var nom = "title"+divi;
				//alert('title: '+nom);
				$(divi).fadeOut(200, null);
				//$(nom+'#up').hide();
				//$(nom+'#down').show();
			}else{
				$(divi).fadeIn(200, null);
				$(divi).parent().children('.glyphicon-chevron-down').hide();
				$(divi).parent().children('.glyphicon-chevron-up').show();
				//$(nom+'#up').show();
				//$(nom+'#down').hide();
			}
		}
	</script>
	<?php include("footer.php"); ?>