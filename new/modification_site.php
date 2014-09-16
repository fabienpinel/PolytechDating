<?php 
	session_start(); 
	include("header.php");
	$encours="modifier_site"; 
	checkLogin();
	$bdd = connect_database();
	$requete = $bdd->query('SELECT * from infosite');
	
	if(isset($_POST['descriptionLongue']) && isset($_POST['descriptionEleve']) && isset($_POST['descriptionEntreprise'])){
		//update dans la bdd
		$r1 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['descriptionLongue']).'" WHERE nom = "descriptionLongue"');
		$r2 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['descriptionEleve']).'" WHERE nom = "descriptionEleve"');
		$r3 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['descriptionEntreprise']).'" WHERE nom = "descriptionEntreprise"');
		$r4 = $bdd->exec('UPDATE infosite SET contenu = "'.utf8_decode($_POST['nbrdv']).'" WHERE nom = "nbrdv"');

			if(!$r1 && !$r2 && !$r3 && !$r4){
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
    		<?php $res = $requete->fetch(); ?>
    		<div class="form-group">
						<label for="nbrdv" class="col-sm-4 control-label">Nombre de Rdv autorisés</label>
						<div class="col-sm-8">
							<input type="text" name="nbrdv" id="nbrdv" class="form-control" value="<?php echo $res['contenu']; ?>" required />
						</div>
				</div>
				<?php while($res = $requete->fetch()){	?>
					<div class="form-group">
						<label for="nom" class="col-sm-4 control-label"><?php echo ''.$res['nom'] ?></label>
						<div class="col-sm-8">
							<textarea type="text" name="<?php echo ''.$res['nom'] ?>" id="<?php echo ''.$res['nom'] ?>" rows="12" class="form-control"  required><?php echo ''.utf8_encode($res['contenu']) ?></textarea>
						</div>
					</div>
					<?php } ?>
					<button class="btn btn-primary boutonsCompte" name="send" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Enregistrer</button>
		</form>

    </div>
</div>
<?php
	include('footer.php');
?>