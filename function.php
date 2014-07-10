<?php
	function connect_database(){
	try
	{
		$bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $user, $mdp);
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	return $bdd;
}
function entParPromo($promotion, $bdd)
{
	$sql = 'SELECT * FROM entreprise WHERE promotion = "' . $promotion . '"';
	$entreprise = $bdd->query($sql);
	echo 'Voici la liste des entreprises que nous avons s&eacute;l&eacute;ctionn&eacute; pour vous :<br/><ul>';	
	while($donnes = $entreprise->fetch())
	{
			echo '<li>' . $donnes['nom'] . '</li>';
	}
	echo '</ul></p>';
	$entreprise->closeCursor();
}

function tempsRestantPhases()
{	
	$tps_restant1 = mktime(0, 0, 0, 10, 22, 2012) - time();
	$tps_restant2 = mktime(0, 0, 0, 10, 25, 2012) - time();

	$H_restantes1 = $tps_restant1 / 3600;
	$d_restants1 = $H_restantes1 / 24;
	$H_restantes2 = $tps_restant2 / 3600;
	$d_restants2 = $H_restantes2 / 24;

	$H_restantes1 = floor($H_restantes1 % 24);
	$d_restants1 = floor($d_restants1);
	$H_restantes2 = floor($H_restantes2 % 24);
	$d_restants2 = floor($d_restants2);
	
	
	echo'	<ul>
				<li>Phase 1 : du lundi 22 octobre au Mercredi 24 octobre 2012</li>';
	if($tps_restant1 > 0)
		echo'	Il reste <strong>'. $d_restants1 .' jours</strong> et <strong>'. $H_restantes1 .' heures</strong> avant l\'ouverture de la phase 1.<br/> ';
	echo'		<li>Phase 2 : du jeudi 25 octobre au dimanche 28 novembre 2012</li>';
	if($tps_restant2 > 0) 
		echo' 	Il reste <strong>'. $d_restants2 .' jours</strong> et <strong>'. $H_restantes2 .' heures</strong> avant l\'ouverture de la phase 2.';
	echo '</ul>';
}

function tempsRestantEvenement()
{
	$tps_restant = mktime(13, 0, 0, 12, 5, 2013) - time();

	$i_restantes = $tps_restant / 60;
	$H_restantes = $i_restantes / 60;
	$d_restants = $H_restantes / 24;


	$s_restantes = floor($tps_restant % 60); // Secondes restantes
	$i_restantes = floor($i_restantes % 60); // Minutes restantes
	$H_restantes = floor($H_restantes % 24); // Heures restantes
	$d_restants = floor($d_restants); // Jours restants
	
	echo '	<p>Nous sommes le '. strftime('<strong>%d %B %Y</strong>, et il est <strong>%Hh%M</strong>') .'.<br />
			Il reste <strong>'. $d_restants .' jours</strong> et <strong>'. $H_restantes .' heures</strong> avant l\'&eacute;v&eacute;nement.</p>';
}

function formulaire($cible)
{
	$si = array('IAM', 'IMAFA', 'IHM', 'KIS', 'UN', 'VIM', 'AL', 'CSSR');
	$elec = array('GSE','TNS', 'CCS', 'TR');
	?><script type="text/javascript"> 
			function changerspe(){ 
				var type = document.getElementById('promotion').options[document.getElementById('promotion').selectedIndex].value; 
				if(type == 'SI5' || type == 'IFI'){ 
					//document.getElementById('parcoursSI').style.display='block'; 
					document.getElementById('parcoursELEC').setAttribute('style','display:none');
					document.getElementById('parcoursMAM').setAttribute('style','display:none');
					document.getElementById('parcoursSI').setAttribute('style','display:table-row');
				}else if(type == 'ELEC5'){ 
					//document.getElementById('parcoursELEC').style.display='block'; 
					document.getElementById('parcoursSI').setAttribute('style','display:none');
					document.getElementById('parcoursMAM').setAttribute('style','display:none');
					document.getElementById('parcoursELEC').setAttribute('style','display:table-row');
				 
				}else if(type == 'MAM5'){ 
					//document.getElementById('parcoursELEC').style.display='block'; 
					document.getElementById('parcoursSI').setAttribute('style','display:none');
					document.getElementById('parcoursELEC').setAttribute('style','display:none');
					document.getElementById('parcoursMAM').setAttribute('style','display:table-row');
				} 
				else{
					document.getElementById('parcoursSI').setAttribute('style','display:none');
					document.getElementById('parcoursELEC').setAttribute('style','display:none');
					document.getElementById('parcoursMAM').setAttribute('style','display:none');
				}
			} 
			</script>
<?php
	echo
		'<div id="inscription">
		
		<!-- D�but du formulaire -->
		<table>
			<form id="formPhaseI" action="' .$cible. '.php" method="post" onSubmit="return verifForm(this, 0)" enctype="multipart/form-data">
			
			<!-- Nom -->
			<tr>
				<td>
					<label for="nom">Nom</label>
				</td>
				<td>
					<input type="text" style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="nom" id="nom" />
				</td>
			</tr>

			<!-- Pr�nom -->
			<tr>
				<td>
					<label for="prenom">Pr&eacute;nom</label>
				</td>
				<td>
					<input type="text" style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="prenom" id="prenom" />
				</td>
			</tr>

			<!-- Promotion -->
			<tr>
				<td>
					<label for="promotion">Promotion</label>
				</td>
				<td>
					<select style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 25px" name="promotion" id="promotion"  onchange="changerspe()">
						<option value=""></option>
						<option value="SI5">INGENIEUR INFORMATIQUE</option>
						<option value="ELEC5">INGENIEUR ELECTRONIQUE</option>
						<option value="MAM5">INGENIEUR MAM</option>
						<option value="M2 IMAFA">M2 IMAFA</option>
						<option value="IFI">M2 IFI</option>
					</select>
				</td>
			</tr>
				<!-- Parcours -->
			<tr id="parcoursMAM" style="display: none;">
				<td>
					<label for="parcoursMAM">Parcours</label>
				</td>
				<td>
					<select style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 25px" name="parcoursMAM" id="parcoursMAM">
						<option value=""></option>
						<option value="IMAFA">IMAFA</option>
						<option value="INUM">INUM</option>
						<option value="VIM">VIM</option>
					</select>
				</td>
			</tr>
			<!-- Parcours -->
			<tr id="parcoursSI" style="display: none;">
				<td>
					<label for="parcoursSI">Parcours</label>
				</td>
				<td>
					<select style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 25px" name="parcoursSI" id="parcoursSI">
						<option value=""></option>
						<option value="IAM">IAM</option>
						<option value="IMAFA">IMAFA</option>
						<option value="IHM">IHM</option>
						<option value="KIS">KIS</option>
						<option value="UN">UN</option>
						<option value="VIM">VIM</option>
						<option value="AL">AL</option>
						<option value="CSSR">CSSR</option>
					</select>
				</td>
			</tr>
			<!-- Parcours -->
			<tr id="parcoursELEC" style="display: none;">
				<td>
					<label for="parcoursELEC">Parcours</label>
				</td>
				<td>
					<select style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 25px" name="parcoursELEC" id="parcoursELEC">
						<option value=""></option>
						<option value="GSE">GSE</option>
						<option value="TNS">TNS</option>
						<option value="CCS">CCS</option>
						<option value="TR">TR</option>
					</select>
				</td>
			</tr>
			
			<!-- E-mail -->
			<tr>
				<td>
					<label for="mail">E-mail</label>
				</td>
				<td>
					<input type="text" style="width:200px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="mail" id="mail"/> @polytech.unice.fr
				</td>
			</tr>
			
			
			
			<tr>
				<td>
					<label for="cv">CV (en .pdf)</label>
				</td>
				<td>
				 	<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
					<input type="file" name="cv" id="cv"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="motscles">2 mots qui vous caractérisent (libre expression)</label>
				</td>
				<td>
				 	<input type="text" style="width:150px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="motcles1" id="motcles1"/>
				 	<input type="text" style="width:150px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="motcles2" id="motcles2"/>
				</td>
			</tr>
			
			
			<!-- Mot de passe -->
			<tr>
				<td>
					<label for="pass">Mot de passe</label>
				</td>
				<td>
					<input type="password" style="width:150px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="pass" id="pass"/>
				</td>
			</tr>
			
			<!-- Confirmation -->
			<tr>
				<td>
					<label for="pass2">Confirmation</label>
				</td>
				<td>
					<input type="password" style="width:150px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="pass2" id="pass2"/>
				</td>
			</tr>

			<!-- Envoi ou remise � z�ro -->
			<tr>
				<td>
				</td>
				<td>
					<div style="text-align: right">
					<input class="submit2" name="send" type="submit" value="Envoyer" /><input class="submit22" name="reset" type="reset" value="Remettre &agrave; z&eacute;ro" />
					</div>
				</td>
			</tr>
		</form>

		</table>
		<!-- Fin du formulaire -->
		
		</div>
	</div>';
}

function toStringFormPhases()
{
	$jour = 28;//date('j');
	$mois = 10;//date('n');
	
	if($mois == 10)
	{
		if($jour > 24)
			formulaire('phase1');
		elseif($jour > 17 && $jour < 25)
			formulaire('phase2');
		else
			echo '<p> Nous sommes le ' . date('j F Y') . '. L\'inscription pour la phase1 est ferm�. Elle ouvrira d�s le 18 octobre 2012.</p>';
	}
	else
	{
		if($mois < 10)
			echo '<p> Nous sommes le ' . date('j F Y') . '. L\'inscription pour la phase1 est ferm�. Elle ouvrira d�s le 18 octobre 2012.</p>';
		else
			echo 'Les phases d\'inscriptions sont d�sormais termin�es. Cependant vous avez la possibilit� de prendre contact avec les organisateurs via l\'onglet Contact. Merci de votre compr�hension.';
	}
}

function connexion($bdd)
{
	// V�rification des identifiants
	$req = $bdd->prepare('SELECT id FROM membre WHERE mail = "' .$_POST['mail']. '" AND pass = "' .$_POST['pass']. '"');
	$req->execute(array(
		'mail' => $_POST['mail'],
		'pass' => $_POST['pass']));

	$resultat = $req->fetch();

	if (!$resultat)
	{
		echo 'Mauvais identifiant ou mot de passe !';
	}
	else
	{
		session_start();
		$_SESSION['id'] = $resultat['id'];
		$_SESSION['mail'] = $_POST ['mail'];
		echo 'Vous �tes connect� !';
	}

	if (isset($_SESSION['id']) AND isset($_SESSION['mail']))
	{
		echo 'Bonjour ' . $_SESSION['mail'];
		$bdd->exec('UPDATE  `polytech_dating`.`membre` SET  `connecte` =  1 WHERE  `membre`.`id` =' .$_SESSION['id']);
	}
}

function redirect($url, $time=3) 
{      
   //On v�rifie si aucun en-t�te n'a d�j� �t� envoy�     
   if (!headers_sent()) 
   { 
     header("refresh: $time;url=$url");  
     exit; 
   } 
   else 
   { 
     echo '<meta http-equiv="refresh" content="',$time,';url=',$url,'">'; 
   } 
} 
?>
