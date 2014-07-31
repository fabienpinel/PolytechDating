<?php 
	session_start(); 
	$encours="compte";
	include("header.php");
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
			echo'<p style="font-size : 24px;color : blue;">Voici la liste des rendez-vous pris par les étudiants :<br/></p>';
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
			
			echo'<table>';
			while($rdv = $req->fetch())
				echo'<tr><td>' .$rdv['nom']. '</td><td>' .$rdv['prenom']. '</td><td>' .$rdv['membre']. '</td><td>' .$rdv['entreprise']. '</td><td>' .$rdv['rdv']. '</td></tr>';
			echo'</table>';
				
			echo'<p style="font-size : 24px;color : blue;">Voici les messages laiss&eacute;es sur la boite <strong>Contact</strong> :<br/></p>';
			
			$req = $bdd->query('	SELECT * FROM message');
			
			while($message = $req->fetch())
				echo'<p>' .$message['nom']. ' ' .$message['prenom']. ' en ' .$message['membre']. ' a laiss&eacute; un message.<br/>
						E-mail : ' .$message['mail']. '<br/>
						"' .$message['texte']. '"
					</p>';	
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
					echo'<p>Attention ! À partir du 2 Décembre, les rendez-vous ne seront plus modifiables.</p>';
					$req = $bdd->query('	SELECT entreprise.nom AS entreprise, rdv.heure AS heure, rdv.id AS id
											FROM rdv
											INNER JOIN entreprise
												ON entreprise.id = rdv.entreprise
											INNER JOIN membre
												ON membre.id = rdv.membre
											WHERE membre.id=' .$_SESSION['id']. '');
											
					$i=0;
					while($donnes = $req->fetch()){
							echo '	
									<form method="post" action="modifierrdv.php">
										<p>Vous avez rendez-vous avec ' .$donnes['entreprise']. ' &agrave; ' .$donnes['heure']. '
										<br/>Pour le supprimer et en choisir un autre parmis ceux encore disponible, cliquez sur <strong>Supprimer</strong>.
										<input type="hidden" name="id" value="' .$donnes['id']. '"/>
										<input class="submit" name="send" type="submit" value="Supprimer" />
									</form>';
									$i++;
				
					}
					if($i>=1){
						echo "vous ne pouvez plus prendre de rendez-vous, ils sont limités à 1/personne pour le moment.";
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
       <!-- <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>-->
        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
      </form>

		</div>';
	}

	echo '</div></div>';
	include("footer.php"); ?>