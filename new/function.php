<?php
function connect_database(){
	include('variables.php');
	try
	{
		$bdd = new PDO('mysql:host='.$host.';dbname='.$bdd.'', $user,$mdp);
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
