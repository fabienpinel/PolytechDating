<?php session_start(); $encours="moncompte"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Polytech'Dating - Les entreprises</title>
	<link rel="stylesheet" href="style.css" />
	<link rel="icon" type="image/png" href="/images/icon.ico" />
	<script type="text/javascript" src="verifForm.js"></script>
</head>
<body>

	
	<?php include("header.php");
	try
	{
		$bdd = new PDO('mysql:host=...;dbname=...', '...', '...');
		
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	//echo '<center><img src="/images/en_maintenance.jpg" style="width:80%;height:80%;"/></center>';
	/*
	*	Si les identifiants sont corrects
	*/
	if (isset($_SESSION['id']) AND isset($_SESSION['mail']))
	{
		// Si compte root
		if($_SESSION['mail'] == 'root')
		{
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
		else
		{
			//if($_SESSION['mail'] == 'boumlik')
			//{
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
					echo'	Vous n\'avez pas encore pris(e) de rendez-vous.
							<p> Afin de prendre un nouveau rendez-vous, cliquez <a href="nouveaurdv.php">ici</a>.</p>';		
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
						echo'	<p> Afin de prendre un nouveau rendez-vous, cliquez <a href="nouveaurdv.php">ici</a>.</p>';	
					}
				}
			/*}
			else 
			{
				echo'<center><p style="font-size:20px;">Vous ne pouvez plus prendre de rendez-vous.</p></center>';	
			}*/
		}
	}
	else
	{
		echo '<div id="compte">
		Cette rubrique va vous permettre de gérer vos rendez-vous : 
		
		<table>
			<form action="connexion.php" method="post" onSubmit="return verifForm(this, 2)">
			<tr>
				<td>
					<label for="mail">E-mail :</label>
				</td>
				<td>
					<input style="width:150px" type="text" name="mail" id="mail" />@polytech.unice.fr
				</td>
			</tr>
			<tr>
				<td>
					<label for="pass">Mot de passe :</label>
				</td>
				<td>
					<input style="width:150px" type="password" name="pass" id="pass" />
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<input class="submit" name="send" type="submit" value="Connexion" />
				</td>
			</tr>
		</table>
		</div>';
	}
	include("footer.php") ?>

</body>
</html>