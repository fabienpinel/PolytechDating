<?php
function razbdd(){
	/*
		desactiver toutes les entreprises
		Supprimer tous les rdv
		re-normaliser la table heure 
		supprimer les messages
		supprimer les membres ?

	*/
		$bdd = connect_database();
	//désactiver toutes les entreprises
		$req = $bdd->exec('UPDATE entreprise SET active = FALSE WHERE 1=1;');
	//Supprimer tous les rendez-vous
		$req = $bdd->exec('DELETE from rdv where 1=1;');
	//réinitialiser la table heure
		$req = $bdd->exec('UPDATE heure SET 14h00=0, 14h20=0, 14h40=0, 15h00=0, 15h20=0,15h40=1, 16h00=0, 16h20=0, 16h40=0, 17h00=0 where 1=1;');
	//supprimer les messages de la BDD
		$req = $bdd->exec('DELETE FROM message WHERE 1=1;');
}
function razEtudiants(){
	$bdd = connect_database();
	//supprimer tous les étudiants et en cascade supprimer tous les rdv/messages etc.
	$req = $bdd->exec('DELETE from membre where mail!="root@root.root";');
	$req = $bdd->exec('UPDATE heure SET 14h00=0, 14h20=0, 14h40=0, 15h00=0, 15h20=0,15h40=1, 16h00=0, 16h20=0, 16h40=0, 17h00=0 where 1=1;');
	//supprimer les CVs ?
}
	function downloadCVTheque(){
	// On instancie la classe.
		//chmod($dossier, 755);
		$zip = new ZipArchive();
		
		if(is_dir('./_/cv/'))
		{
        // On teste si le dossier existe, car sans ça le script risque de provoquer des erreurs.
			
			if($zip->open('./_/cvarchive/CVTheque.zip', ZipArchive::CREATE) == TRUE)
			{
	  // Ouverture de l’archive réussie.

	  // Récupération des fichiers.
				$fichiers = scandir('./_/cv/');
	  // On enlève . et .. qui représentent le dossier courant et le dossier parent.
				unset($fichiers[0], $fichiers[1], $fichiers[2]);
				
				foreach($fichiers as $f)
				{
	    // On ajoute chaque fichier à l’archive en spécifiant l’argument optionnel.
	    // Pour ne pas créer de dossier dans l’archive.
					if(!$zip->addFile('./_/cv/'.$f, $f))
					{
						echo 'Impossible d&#039;ajouter &quot;'.$f.'&quot;.<br/>';
					}
				}
				
	  // On ferme l’archive.
				$zip->close();
				
	  // On peut ensuite, comme dans le tuto de DHKold, proposer le téléchargement.
	  header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier).
	  header('Content-Disposition: attachment; filename="CVTheque.zip"'); //Nom du fichier.
	  header('Content-Length: '.filesize('CVTheque.zip')); //Taille du fichier.
	  
	  readfile('./_/cvarchive/CVTheque.zip');
	}
	else
	{
	  // Erreur lors de l’ouverture.
	  // On peut ajouter du code ici pour gérer les différentes erreurs.
		echo 'Erreur, impossible de créer l\'archive.';
	}
}
else
{
        // Possibilité de créer le dossier avec mkdir().
	echo 'Le dossier &quot;upload/&quot; n\'existe pas.';
}
}
function entrepriseEncoreDisponible($id){
	$bdd = connect_database();
	$entreprise = $bdd->query('SELECT * FROM heure where entreprise='.$id);
	$donnees = $entreprise->fetch();
	return !($donnees['14h00'] && $donnees['14h20'] && $donnees['14h40'] && $donnees['15h00'] && $donnees['15h40'] && $donnees['16h00'] && $donnees['16h20'] && $donnees['16h40'] && $donnees['17h00']);
}
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
function checkLogin(){
	if(!isset($_SESSION['id']) || !isset($_SESSION['mail'])){
		redirect("./index.php","0");
	}
}

function entParPromo($promotion, $bdd)
{
	$sql = 'SELECT * FROM entreprise WHERE promotion = "' . $promotion . '"';
	$entreprise = $bdd->query($sql);
	echo 'Voici la liste des entreprises que nous avons sélectionné pour vous :<br/><ul>';	
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
	Il reste <strong>'. $d_restants .' jours</strong> et <strong>'. $H_restantes .' heures</strong> avant l\'évènement.</p>';
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
			echo '<p> Nous sommes le ' . date('j F Y') . '. L\'inscription pour la phase1 est fermé. Elle ouvrira dès le 18 octobre 2012.</p>';
	}
	else
	{
		if($mois < 10)
			echo '<p> Nous sommes le ' . date('j F Y') . '. L\'inscription pour la phase1 est fermé. Elle ouvrira dès le 18 octobre 2012.</p>';
		else
			echo 'Les phases d\'inscriptions sont désormais terminées. Cependant vous avez la possibilité de prendre contact avec les organisateurs via l\'onglet Contact. Merci de votre compréhension.';
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
function getInfoSiteInformation($info){
	$bdd= connect_database();
	$req = $bdd->query('SELECT * FROM infosite WHERE nom="'.$info.'";');
	$donnees = $req->fetch();
	return utf8_encode($donnees['contenu']);
}
function getMailContact(){
	return getInfoSiteInformation("mailContact"); 
}
function getInscriptionsOuvertes(){
	return getInfoSiteInformation("inscriptionsOuvertes"); 
}
function getEditionNumber(){
	return getInfoSiteInformation("edition"); 
}
function getDescriptionLongue(){
	return getInfoSiteInformation("descriptionLongue"); 
}
function getDescriptionEleve(){
	return getInfoSiteInformation("descriptionEleve");
}
function getDescriptionEntreprise(){
	return getInfoSiteInformation("descriptionEntreprise");
}
?>
