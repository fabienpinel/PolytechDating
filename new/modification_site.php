<?php 
session_start(); 
include("header.php");
$encours="modifier_site"; 
checkLogin();
$bdd = connect_database();


if(isset($_POST['descriptionLongue']) && isset($_POST['descriptionEleve']) && isset($_POST['descriptionEntreprise'])){
		//update dans la bdd
	$r1 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['descriptionLongue']).'" WHERE nom = "descriptionLongue"');
	$r2 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['descriptionEleve']).'" WHERE nom = "descriptionEleve"');
	$r3 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['descriptionEntreprise']).'" WHERE nom = "descriptionEntreprise"');
	$r4 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['nbrdv']).'" WHERE nom = "nbrdv"');
	$r5 = $bdd->exec('UPDATE infosite SET contenu = "'.$_POST['priseRdvActive'].'" WHERE nom = "priseRDVActive"');
	$r6 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['mailContact']).'" WHERE nom = "mailContact"');
	$r7 = $bdd->exec('UPDATE infosite SET contenu = "'.$_POST['inscriptionsOuvertes'].'" WHERE nom = "inscriptionsOuvertes"');
	if(!$r1 && !$r2 && !$r3 && !$r4 && !$r5 && !$r6 && !$r7){
		redirect("./compte.php?code=3","0");
	}else{
				//Tout s'est bien passé
		redirect("./compte.php?code=2","0");
	}
}
?>

<div class="jumbotron">
	<div class="container">
		<h1>Modifier le site</h1>
		<form data-toggle="validator" role="form" class="form-horizontal" id="modificationSite" action="modification_site.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="inscriptionsOuvertes" class="col-sm-4 control-label">Ouvrir les inscriptions</label>
				<div class="col-sm-8">
					<input type="checkbox" name="inscriptionsOuvertes" id="inscriptionsOuvertes" class="form-control"  <?php if(getInfoSiteInformation("inscriptionsOuvertes")){echo 'checked';} ?>>
				</div>
			</div>
			
			<div class="form-group">
				<label for="nbrdv" class="col-sm-4 control-label">Nombre de Rdv autorisés</label>
				<div class="col-sm-8">
					<input type="text" name="nbrdv" id="nbrdv" class="form-control" value="<?php echo getInfoSiteInformation("nbrdv"); ?>" required />
				</div>
			</div>
			<div class="form-group">
				<label for="priseRdvActive" class="col-sm-4 control-label">Activer la prise de rendez-vous</label>
				<div class="col-sm-8">
					<input type="checkbox" name="priseRdvActive" id="priseRdvActive" class="form-control"  <?php if(getInfoSiteInformation("priseRDVActive")){echo 'checked';} ?>>
				</div>
			</div>
			<?php 
			$requete = $bdd->query('SELECT * from infosite WHERE nom LIKE "description%"');
			while($res = $requete->fetch()){	
				?>
				<div class="form-group">
					<label for="nom" class="col-sm-4 control-label"><?php echo ''.$res['nom'] ?></label>
					<div class="col-sm-8">
						<textarea type="text" name="<?php echo ''.$res['nom'] ?>" id="<?php echo ''.$res['nom'] ?>" rows="12" class="form-control"  required><?php echo ''.utf8_encode($res['contenu']) ?></textarea>
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label for="mailContact" class="col-sm-4 control-label">Mail de contact</label>
					<div class="col-sm-8">
						<input type="text" name="mailContact" id="mailContact" class="form-control" value="<?php echo getInfoSiteInformation("mailContact"); ?>" required />
					</div>
				</div>

				<div class="boutonsCompte">
					<button class="btn btn-primary " name="send" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Enregistrer</button>
					<a href="./compte.php" ><button type="button"  class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Annuler</button></a>
				</div>
			</form>

		</div>
	</div>
	<?php
	include('footer.php');
	?>