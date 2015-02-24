<?php 
/**
 * \file      rdv.php
 * \author    Fabien Pinel
 * \version   1.0
 * \date      24 Février 2015
 * \brief     Choix de l'entreprise lors de la procédure de prise de rendez-vous par l'étudiant
 * \details   
 */
session_start();
include("header.php");
$encours="rdv"; 
checkLogin();

$bdd = connect_database();
$req = $bdd->query('select * from infosite where nom="priseRDVActive"');
$donnes = $req->fetch();
if(!$donnes['contenu']){
	redirect("./compte.php","0");
}
$req = $bdd->query('select * from infosite where nom="nbrdv"');
$donnes = $req->fetch();
$nombreRDVParPersonne = $donnes['contenu'];
$req = $bdd->query('	SELECT entreprise.nom AS entreprise, rdv.heure AS heure, rdv.id AS id
	FROM rdv
	INNER JOIN entreprise
	ON entreprise.id = rdv.entreprise
	INNER JOIN membre
	ON membre.id = rdv.membre
	WHERE membre.id=' .$_SESSION['id']. '');

$i=0;
while($donnes = $req->fetch()){
	$i++;
	
}
if($i>=$nombreRDVParPersonne){
	redirect("./compte.php","0");
}

echo'<div class="jumbotron">
<div class="container">';
	
	echo  '<p>L\'&eacute;quipe du Polytech Dating vous offre la possibilit&eacute; de choisir un rendez-vous parmi ces entreprises.</p>';
	
		/*if($_SESSION['promotion']=="SI5" || $_SESSION['promotion']=="IFI"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="SI" ORDER BY nom');
			
		}else if($_SESSION['promotion']=="ELEC5"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="ELEC" ORDER BY nom');
		}else if($_SESSION['promotion']=="M2 IMAFA"){
			$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="IMAFA" ORDER BY nom');
		}else if($_SESSION['promotion']=="MAM5"){
			if($_SESSION['parcours']=="IMAFA"){
				$entreprise = $bdd->query('SELECT * FROM entreprise WHERE com="IMAFA" ORDER BY nom');
			}
			else{
				$entreprise = $bdd->query('SELECT * FROM entreprise ORDER BY nom');
			}
		}else{
			$entreprise = $bdd->query('SELECT * FROM entreprise ORDER BY nom');
		}*/
		$entreprise = $bdd->query('SELECT * FROM entreprise WHERE active=TRUE ORDER BY nom');
		echo '<p>Veuillez choisir celle avec laquelle vous souhaiteriez avoir un entretien :</p>';
		echo '<form data-toggle="validator" method="post" action="heure.php" class="form-horizontal formulaireRDV" >';
		$i=0;
		while($donnes = $entreprise->fetch()){
			if(entrepriseEncoreDisponible($donnes['id'])){
				echo '<div class="radio">
				<label>
					<input type="radio" name="choix" value="' .$donnes['nom']. '" id="' .$donnes['nom']. '" required>
					' .$donnes['nom']. '
				</label>
			</div>';
			$i++;
		}
	}
	if($i==0){
		//Aucune entreprise n'a été affichée.
		echo '</p></form>';
		
		echo  '<div class="alert alert-danger" role="alert">
      		Aucune entreprise disponible.
    		</div>';
    	echo '<a href="./compte.php" ><button type="button" style="margin-left: 2px;" class="btn btn-warning">Retour à mon compte</button></a>';
		echo '</div></div>';
	}else{
		echo'<input class="submit btn btn-primary" name="send" type="submit" value="Valider" />';
		echo '<a href="./compte.php" ><button type="button" style="margin-left: 2px;" class="btn btn-warning">Retour à mon compte</button></a>';
		echo '</p></form>';
		echo '</div></div>';
	}
	
	
	include("footer.php") ?>