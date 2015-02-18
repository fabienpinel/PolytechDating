<?php 
session_start(); 
	/*
	TODO
	bouton raz rdv entreprise par entreprise
	historique d'une année sur l'autre
	*/
	$encours="compte";
	include("header.php");
	include("variables.php");

	
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


	/*
	*	Si les identifiants sont corrects
	*/
	if (isset($_SESSION['id']) AND isset($_SESSION['mail']))
	{
		//fonction de connexion située dans function.php
		$bdd = connect_database();
		// Si compte root
		if($_SESSION['type'] == 'root'){
			getRootContent($bdd);
		}
		// Si compte user
		else if($_SESSION['type'] == 'membre'){
			getUserContent($bdd);
		}
		//Si compte entreprise
		else if($_SESSION['type'] == 'entreprise'){	
			getCompanyContent($bdd);
		}
	}
	else
	{	
		//Si pas connecté
		getNotConnectedContent();
	}

	echo '</div><!-- fermeture container -->
</div><!-- fermeture jumbotron -->';

/*	##########	FONCTIONS NECESSAIRES AU CONTENU DE LA PAGE    ############# */

/*
	Fonction affichant le contenu de la page 
	"Compte" lorsque l'utilisateur est root
*/
	function getRootContent($bdd){
		/*	Prise en compte des codes retours */
		if(isset($_GET['code'])){
			switch($_GET['code']){
				case 2:
    			//Tout s'est bien passé
				echo ' <div class="alert alert-success" role="alert">La modification du site s\'est terminée avec succès.</div>';
				break;
				case 3:
    			//Il y a eu des erreurs
				echo ' <div class="alert alert-danger" role="alert">La modification du site ne s\'est pas bien terminée. Veuillez recommencer.</div>';
				break;
			}
		}
		if(isset($_GET['dlcvtheque'])){
			downloadCVTheque();
		}else if(isset($_GET['raz'])){
			razbdd();
			redirect("./compte.php","0");
		}else if(isset($_GET['razEtudiants'])){
			razEtudiants();
			redirect("./compte.php","0");
		}
		echo '<script>
		function raz(){
			if(confirm("êtes vous sûr de vouloir tout remettre à zéro ? ->rdv, messages...")){
				document.location.href="?raz" ;
			}
		}
		function razEtudiants(){
			if(confirm("êtes vous sûr de vouloir supprimer tous les étudiants ? ->rdv, messages...")){
				document.location.href="?razEtudiants" ;
			}
		}
		</script>';
	


	/* Traitement du formumlaire de changememt d'état si présent */
	if(isset($_POST['idEntreprise']) && isset($_POST['activation'])){
		if($_POST['activation']){
			$resultat = $bdd->exec('UPDATE entreprise SET active = FALSE WHERE id = "'.$_POST['idEntreprise'].'"');
		}else{
			$resultat = $bdd->exec('UPDATE entreprise SET active = TRUE WHERE id = "'.$_POST['idEntreprise'].'"');
		}
		
		if($resultat){
			$m = $bdd->query('SELECT mail FROM entreprise WHERE id = "'.$_POST['idEntreprise'].'"');
			$mail = $m->fetch();
			echo '<div class="alert alert-success" role="alert">Le changement d\'état de l\'entreprise s\'est terminée avec succès. Notification à '.$mail['mail'].'</div>';
			mail(''.$mail['mail'], "Activation de votre compte Polytech Dating", "Bonjour, Votre compte a été activé sur le site du Polytech Dating. Les étudiants peuvent désormais prendre des rendez-vous avec vous.");
		}else{
			echo '<div class="alert alert-danger" role="alert">Le changement d\'état de l\'entreprise ne s\'est pas bien terminée.</div>';	
		}
	}
			/*
				A REVOIR !!!
				TODO
			*/
				echo '<div style="display: inline-block;">';
				echo '<button class="btn btn-default" onClick="tout();" style="display: inline-block;"><span class="glyphicon glyphicon-minus" id="up" ></span> Tout</button>';
				echo'<div class="boutons">
				<a class="btn btn-success" href="?dlcvtheque"><span class="glyphicon glyphicon-save"></span> Télécharger la CVThèque</a>
				<a class="btn btn-success" href="./inscription.php?type=entreprise"><span class="glyphicon glyphicon-plus"></span> Ajouter une entreprise</a>
				<a class="btn btn-warning" href="./modification_site.php"  role="button"><span class="glyphicon glyphicon-cog"></span> Modifier le site</a> 
				<button class="btn btn-danger" onClick="raz()"><span class="glyphicon glyphicon-remove-circle"></span> RAZ générale</button>
				<button class="btn btn-danger" onClick="razEtudiants()"><span class="glyphicon glyphicon-remove-circle"></span> RAZ étudiants</button>  
				
			</div></div>';
			/* LISTE DES ETUDIANTS INSCRITS */
			getListRegisteredStudentWithRoot($bdd);

			/*  LISTE DES RDV */ 
			getListMeetingsWithRoot($bdd);

			/* LISTE DES ENTREPRISES */
			getListCompanyWithRootAccount($bdd);
		}
/*
	Affichage des étudiants inscrits pour le compte root
*/
	function getListRegisteredStudentWithRoot($bdd){
		echo'<h2 class="titleetudiants">Liste des étudiants inscrits <button class="btn btn-default" onClick="reduire(etudiants);"><span class="glyphicon glyphicon-minus" id="up" ></span></button></h2>';
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
	}

/*
	Affichage des rendez vous pris pour le compte root
*/
	function getListMeetingsWithRoot($bdd){
		echo'<h2 class="titlerdvEtudiants">Liste des rendez-vous pris par les étudiants <button class="btn btn-default" onClick="reduire(rdvEtudiants);"><span class="glyphicon glyphicon-minus" id="up" ></span></button></h2>';
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
									echo '<th>Nom</th><th>Prénom</th><th>Promotion</th><th>Entreprise</th><th>Horaire</th>';
									while($rdv = $req->fetch())
										echo'<tr><td>' .$rdv['nom']. '</td><td>' .$rdv['prenom']. '</td><td>' .$rdv['membre']. '</td><td>' .$rdv['entreprise']. '</td><td>' .$rdv['rdv']. '</td></tr>';
									echo'</table>';
									


									/* LISTE DES MESSAGES */
									echo'<h2 id="titlemessages">Messages laissés grâce au formulaire de contact <button class="btn btn-default" onClick="reduire(messages);"><span class="glyphicon glyphicon-minus" id="up" ></span></button></h2>';
									echo '<div id="messages">';
									$req = $bdd->query('SELECT * FROM message');
									
									while($message = $req->fetch())
										echo'<p><b>' .$message['nom']. ' ' .$message['prenom']. '</b> a laiss&eacute; un message.<br/>
									E-mail: <b>' .$message['mail']. '</b><br/>
									Message: ' .$message['texte']. '
								</p>';	

								echo '</div>';
							}
/*
	Affichage de la liste des entreprises pour le compte root
*/    
	function getListCompanyWithRootAccount($bdd){
		echo '<h2 class="titlelistingEntreprise">Liste des entreprises inscrites <button class="btn btn-default" onClick="reduire(listingEntreprise);"><span class="glyphicon glyphicon-minus" id="up" ></span></button></h2>';
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
/*
	Fonction affichant le contenu de la page 
	"Compte" lorsque l'utilisateur est un étudiant "user"
*/
	function getUserContent($bdd){
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
			$req = $bdd->query('select * from infosite where nom="nbrdv"');
			$donnes = $req->fetch();
			$nombreRDVParPersonne = $donnes['contenu'];
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
			if($i>=$nombreRDVParPersonne){
				echo '<div class="alert alert-danger" role="alert">Vous ne pouvez plus prendre de rendez-vous, ils sont limités à '.$nombreRDVParPersonne.'/personne pour le moment.</div>';
			}
			else{
				$req = $bdd->query('select * from infosite where nom="priseRDVActive"');
				$donnes = $req->fetch();
				if($donnes['contenu']){
					echo'	<p> Afin de prendre un nouveau rendez-vous, cliquez <a href="rdv.php">ici</a>.</p>';	
				}else{
					echo '<div class="alert alert-danger" role="alert">La prise de rendez-vous est désactivée.</div>';
				}
				
			}
		}
		getEditAccountButton();
	}

/*
	Fonction affichant le contenu de la page 
	"Compte" lorsque l'utilisateur est une entreprise
*/
	function getCompanyContent($bdd){
		if(!$_SESSION['active']){ ?>
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-warning-sign"></span>
			Votre compte n'est pas actif. Pour demander l'activation afin de participer au prochain Polytech Dating, veuillez contacter Mme Véronique Guérin : <a href="mailto:veronique.guerin@polytech.unice.fr">veronique.guerin@polytech.unice.fr</a>.
		</div>
		<?php } ?>
		<div>
			<div class="alert alert-info" role="alert">
				Pour déposer une annonce de stage, suivre ce lien : <a href="http://offres-stages.polytech.unice.fr/entreprise/" target="_blanck">offres-stages.polytech.unice.fr/entreprise</a>
				
			</div>
		</div>
		<div class="compteEntreprise">
			<div class="entrepriseLayout">
				<img src="./_/images/entreprises/<?php echo $_SESSION['nomImage'].'.'.$_SESSION['formatLogo'];?>" />
				<div id="resume">
					<p>Bonjour <b><?php echo $_SESSION['nom']; ?></b> !</p>
					<p>E-mail : <b><?php echo $_SESSION['mail']; ?></b></p>
					<p>Site web : <a href="<?php echo $_SESSION['website']; ?>" target="_blanck"><?php echo $_SESSION['website']; ?></a></p>
					<p>Vous recherchez des étudiants en : <b><?php echo $_SESSION['com']; ?></b></p>
				</div>
			</div>
			
			<div>
				<h2>Etudiants ayant pris rendez-vous avec <?php  echo $_SESSION['nom']; ?></h2>
				<?php
				$rdvEntreprise = $bdd->query('SELECT membre.nom, membre.prenom, membre.mail, membre.motcles1, membre.motcles2, membre.parcours, membre.promotion AS membre, heure AS rdv, entreprise.nom AS entreprise
					FROM rdv
					INNER JOIN entreprise
					ON entreprise.id = rdv.entreprise 
					INNER JOIN membre
					ON membre.id = rdv.membre
					WHERE entreprise.id = '.$_SESSION["id"].'
					ORDER BY rdv.heure');
				
				echo'<table class="table table-hover">';
				echo '<th>Nom</th><th>Prénom</th><th>Mail<th>Promotion</th><th>Parcours</th><th>Mot cles 1</th><th>Mot cles 2</th><th>Entreprise</th><th>Horaire</th><th>CV</th>';
				while($rdv = $rdvEntreprise->fetch())
					echo'<tr><td>' .$rdv['nom']. '</td><td>' .$rdv['prenom']. '</td><td>' .$rdv['mail']. '</td><td>' .$rdv['membre']. '</td><td>' .$rdv['parcours']. '</td><td>' .$rdv['motcles1']. '</td><td>' .$rdv['motcles2']. '</td><td>' .$rdv['entreprise']. '</td><td>' .$rdv['rdv']. '</td><td><a href="./_/cv/'.$rdv['nom'].'-'.$rdv['prenom'].'-'.$rdv['membre'].'.pdf">Voir le CV</a></td></tr>';
				echo'</table>';



				?>
			</div>

			<?php getEditAccountButton(); ?>
		</div>

		<?php
	}

/*
	Fonction affichant le contenu de la page 
	"Compte" lorsque l'utilisateur n'est pas connecté
*/
	function getNotConnectedContent(){
		?>
		<div id="compte">
			<h3>Cette rubrique va vous permettre de gérer vos rendez-vous.</h3>
			
			<form class="form-signin" role="form" action="connexion.php" method="post">
				<h2 class="form-signin-heading">Connectez vous</h2>
				<input type="text" class="form-control" placeholder="Email" name="mail" id="mail" required="" autofocus="">
				<input type="password" class="form-control" name="pass" id="pass" placeholder="Mot de passe" required="">
				<br />
				<button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
				<a href="./inscription.php"><button class="btn btn-lg btn-success btn-block" type="button" style="margin-top: 1px;">Inscription</button></a>
			</form>

		</div>
		<?php
	}

/*
	Affichage du bouton "Modifier mon compte"
*/
	function getEditAccountButton(){
		?>
		<div class="boutonsCompte">
			<a class="btn btn-warning" href="./modification_cpte.php"  role="button"><span class="glyphicon glyphicon-edit"></span> Modifier mon compte</a> 
		</div>
		<?php
	}
	?>
	<script>
		window.onload = function() {
			/*
			Cacher les div de la page root au chargement pour plus de lisibilité
			reduire('#messages')
			reduire('#listingEntreprise');
			reduire('#rdvEtudiants');
			reduire('#etudiants');
			*/
		}

		function reduire(divi){
			if ($(divi).is(':visible')) {
				$(divi).fadeOut(200, null);
			}else{
				$(divi).fadeIn(200, null);
			}
		}
		function tout(){
			if ($(etudiants).is(':visible') || $(rdvEtudiants).is(':visible') || $(messages).is(':visible') || $(listingEntreprise).is(':visible') ) {
				$(etudiants).fadeOut(200, null);
				$(rdvEtudiants).fadeOut(200, null);
				$(messages).fadeOut(200, null);
				$(listingEntreprise).fadeOut(200, null);

			}else{
				$(etudiants).fadeIn(200, null);
				$(rdvEtudiants).fadeIn(200, null);
				$(messages).fadeIn(200, null);
				$(listingEntreprise).fadeIn(200, null);
			}
		}
	</script>
	<?php include("footer.php"); ?>