<?php 
	session_start(); 
	include("header.php");
	$encours="modifier_compte"; 
	checkLogin();
	$bdd = connect_database();

	if(isset($_POST['type'])){
		//On a reçu un formulaire
		if($_POST['type'] == "entreprise"){
			//une entreprise a modifiée son compte
			$requete = $bdd->exec('UPDATE entreprise SET nom = "'.$_POST['nom'].'", mail = "'.$_POST['mail'].'", website = "'.$_POST['website'].'", com = "'.$_POST['com'].'", pass = "'.md5($_POST['passEntreprise']).'" WHERE id = "'.$_SESSION['id'].'"');

			if(!$requete){
				redirect("./compte.php?code=1","0");
			}else{
				$_SESSION['mail'] = $_POST['mail'];
				$_SESSION['nom'] = $_POST['nom'];
				$_SESSION['com'] = $_POST['com'];
				$_SESSION['website'] = $_POST['website'];
				redirect("./compte.php?code=0", "0");
			}
		}else if($_POST['type'] == "membre"){
				//un membre a modifié son compte

		}
	}
?>

<div class="jumbotron">
    <div class="container">
    	<h1>Modifier mon compte</h1>
    	<p>Vous pouvez modifier vos informations personnelles.</p>
    	<?php

		if($_SESSION['type'] == 'entreprise'){
			$requete = $bdd->query('SELECT * from entreprise WHERE id="'.$_SESSION['id'].'"');
			$res = $requete->fetch();
		?>
			<div id="inscription">
			<!-- Debut du formulaire ENTREPRISE -->
			<form data-toggle="validator" role="form" class="form-horizontal" id="modificationCompteEntreprise" action="modification_cpte.php" method="post" enctype="multipart/form-data">
			
					<!-- Nom -->
					<div class="form-group">
						<label for="nom" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" name="nom" id="nom" class="form-control" value="<?php echo ''.$res['nom'] ?>" required/>
						</div>
					</div>
													
					<!-- EMAIL -->
					<div class="form-group">
						<label for="mail" class="col-sm-4 control-label">E-mail</label>
						<div class="col-sm-8">	
							<input type="email" class="form-control" name="mail" id="mail" value="<?php echo ''.$res['mail'] ?>" required/>
						</div>
					</div>
					<!-- Website -->
					<div class="form-group">
						<label for="website" class="col-sm-4 control-label">Website</label>
						<div class="col-sm-8">
							<input type="text" name="website" id="website" class="form-control" value="<?php echo ''.$res['website'] ?>" required/>
						</div>
					</div>
					<!-- Spécialité -->
					<div class="form-group">
						<label for="com" class="col-sm-4 control-label">Spécialité visée</label>
						<div class="col-sm-8">
							<input type="text" name="com" id="com" class="form-control" value="<?php echo ''.$res['com'] ?>" required/>
						</div>
					</div>
					<!-- LOGO input -->
					<!--<div class="form-group">
						<label for="logo" class="col-sm-4 control-label">Logo (image)</label>
				 		<div class="col-sm-8">
				 			<input type="hidden" name="MAX_FILE_SIZE" value="2097152" class="form-control" />
							<input type="file" name="logo" id="logo" required/>
						</div>
					</div>-->
					<!-- Mot de passe -->
					<div class="form-group">
						<label for="passEntreprise" class="col-sm-4 control-label">Mot de passe</label>
						<div class="col-sm-8">
							<input type="password" name="passEntreprise" id="passEntreprise" class="form-control"  required/>
						</div>
					</div>
					<!-- Confirmation -->
					<div class="form-group">
						<label for="pass2" class="col-sm-4 control-label">Confirmation</label>
						<div class="col-sm-8">
							<input type="password" name="pass2" id="pass2" class="form-control" data-match="#passEntreprise" data-match-error="Les 2 mot de passe sont différents" required/>
						</div>
						<div class="help-block with-errors col-sm-4"></div>
					</div>
					<!-- champ caché pour indiquer que c'est une entreprise -->
					<input type="hidden" name="type" value="entreprise" />	
					<!-- Envoi ou remise � z�ro -->
					<div style="text-align: right">
						<input class="submit2 btn btn-primary" name="send" type="submit" value="Enregistrer" />
						<a href="./compte.php" ><input class="btn btn-danger" value="Annuler" style="width:110px;" /></a>
					</div>
			</form>
		<!-- Fin du formulaire -->
		
		</div>
		<?php
		}else if($_SESSION['type'] == 'membre'){
			$requete = $bdd->query('SELECT * from membre WHERE id="'.$_SESSION['id'].'"');
			$res = $requete->fetch();

			$si = array('IAM', 'IMAFA', 'IHM', 'KIS', 'UN', 'VIM', 'AL', 'CSSR');
			$elec = array('GSE','TNS', 'CCS', 'TR');
		?>


		<script type="text/javascript"> 
			function changerspe(){ 
				var type = document.getElementById('promotion').options[document.getElementById('promotion').selectedIndex].value; 
				if(type == 'SI5' || type == 'IFI'){ 
					//document.getElementById('parcoursSI').style.display='block'; 
					document.getElementById('parcoursELEC').setAttribute('style','display:none');
					document.getElementById('parcoursMAM').setAttribute('style','display:none');
					document.getElementById('parcoursSI').setAttribute('style','display:inherit');
				}else if(type == 'ELEC5'){ 
					//document.getElementById('parcoursELEC').style.display='block'; 
					document.getElementById('parcoursSI').setAttribute('style','display:none');
					document.getElementById('parcoursMAM').setAttribute('style','display:none');
					document.getElementById('parcoursELEC').setAttribute('style','display:inherit');
				 
				}else if(type == 'MAM5'){ 
					//document.getElementById('parcoursELEC').style.display='block'; 
					document.getElementById('parcoursSI').setAttribute('style','display:none');
					document.getElementById('parcoursELEC').setAttribute('style','display:none');
					document.getElementById('parcoursMAM').setAttribute('style','display:inherit');
				} 
				else{
					document.getElementById('parcoursSI').setAttribute('style','display:none');
					document.getElementById('parcoursELEC').setAttribute('style','display:none');
					document.getElementById('parcoursMAM').setAttribute('style','display:none');
				}
			} 
		</script>

		<div id="inscription">
		<!-- Debut du formulaire ETUDIANT -->
			<form data-toggle="validator" role="form" class="form-horizontal" id="modificationCompteMembre" action="modification_cpte.php" method="post" enctype="multipart/form-data">
			
					<!-- Nom -->
					<div class="form-group">
						<label for="nom" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" name="nom" id="nom" class="form-control" value="<?php echo ''.$res['nom'] ?>" required/>
						</div>
					</div>
					<!-- Pr�nom -->
					<div class="form-group">
						<label for="prenom" class="col-sm-4 control-label">Pr&eacute;nom</label>
						<div class="col-sm-8">
							<input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo ''.$res['prenom'] ?>" required/>
						</div>
					</div>
					<!-- Promotion -->
					<div class="form-group">
						<label for="promotion" class="col-sm-4 control-label">Promotion</label>
						<div class="col-sm-8">
							<select name="promotion" id="promotion"   onchange="changerspe()" class="form-control" required>
								<option value="" disabled selected>Sélectionnez votre promotion</option>
								<option value="SI5">INGENIEUR INFORMATIQUE</option>
								<option value="ELEC5">INGENIEUR ELECTRONIQUE</option>
								<option value="MAM5">INGENIEUR MAM</option>
								<option value="M2 IMAFA">M2 IMAFA</option>
								<option value="IFI">M2 IFI</option>
							</select>
						</div>
					</div>
					<!-- Parcours -->
					<div class="form-group" id="parcoursMAM" style="display: none;">
							<label for="parcoursMAM" class="col-sm-4 control-label">Parcours</label>
							<div class="col-sm-8">	
								<select name="parcoursMAM" id="parcoursMAM" class="form-control" >
									<option value="" disabled selected>Sélectionnez votre parcours</option>
									<option value="IMAFA">IMAFA</option>
									<option value="INUM">INUM</option>
									<option value="VIM">VIM</option>
								</select>
							</div>
					</div>
					<!-- Parcours -->
					<div class="form-group" id="parcoursSI" style="display: none;">
							<label for="parcoursSI" class="col-sm-4 control-label">Parcours</label>
							<div class="col-sm-8">
								<select name="parcoursSI" id="parcoursSI" class="form-control" >
									<option value="" disabled selected>Sélectionnez votre parcours</option>
									<option value="IAM">IAM</option>
									<option value="IMAFA">IMAFA</option>
									<option value="IHM">IHM</option>
									<option value="KIS">KIS</option>
									<option value="UN">UN</option>
									<option value="VIM">VIM</option>
									<option value="AL">AL</option>
									<option value="CSSR">CSSR</option>
								</select>
							</div>
					</div>
					<!-- Parcours -->
					<div class="form-group" id="parcoursELEC" style="display: none;">
							<label for="parcoursELEC" class="col-sm-4 control-label">Parcours</label>
							<div class="col-sm-8">
								<select name="parcoursELEC" id="parcoursELEC" class="form-control" >
									<option value="" disabled selected>Sélectionnez votre parcours</option>
									<option value="GSE">GSE</option>
									<option value="TNS">TNS</option>
									<option value="CCS">CCS</option>
									<option value="TR">TR</option>
								</select>
							</div>
					</div>
			
					<!-- EMAIL -->
					<div class="form-group">
						<label for="mail" class="col-sm-4 control-label">E-mail</label>
						<div class="col-sm-4">	
							<input type="text" class="form-control" name="mail" id="mail" value="<?php echo ''.$res['mail'] ?>" required/>
						</div>
						<div class="col-md-3 control-label">
							<label>@polytech.unice.fr</label>
						</div>
					</div>
					<!-- CV input -->
					<!--<div class="form-group">
						<label for="cv" class="col-sm-4 control-label">CV (en .pdf)</label>
				 		<div class="col-sm-8">
				 			<input type="hidden" name="MAX_FILE_SIZE" value="2097152" class="form-control" />
							<input type="file" name="cv" id="cv" required/>
						</div>
					</div>-->
					<!-- 2 mots caractéristiques  -->
					<div class="form-group">
						<label for="motscles" class="col-sm-4 control-label">2 mots qui vous caractérisent (libre expression)</label>
				 		<div class="col-sm-4">
				 			<input type="text" name="motcles1" id="motcles1" value="<?php echo ''.$res['motcles1'] ?>" class="form-control" required/>
				 		</div>
				 		<div class="col-sm-4">
				 			<input type="text" name="motcles2" id="motcles2" value="<?php echo ''.$res['motcles2'] ?>" class="form-control" required/>
						</div>
					</div>
					<!-- Mot de passe -->
					<div class="form-group">
						<label for="passEtudiant" class="col-sm-4 control-label">Mot de passe</label>
						<div class="col-sm-8">
							<input type="password" name="passEtudiant" id="passEtudiant" class="form-control" placeholder="Mot de passe" required/>
						</div>
					</div>
					<!-- Confirmation -->
					<div class="form-group">
						<label for="pass2Etudiant" class="col-sm-4 control-label">Confirmation</label>
						<div class="col-sm-8">
							<input type="password" name="pass2Etudiant" id="pass2Etudiant" placeholder="Confirmation" class="form-control" data-match="#passEtudiant" data-match-error="Les 2 mot de passe sont différents" required/>
						</div>
						<div class="help-block with-errors col-sm-4"></div>
					</div>
					<!-- champ caché pour indiquer que c'est un membre -->
					<input type="hidden" name="type" value="membre" />
					<!-- Envoi ou remise � z�ro -->
					<div style="text-align: right">
						<input class="btn btn-primary" name="send" type="submit" value="Envoyer" />
						<a href="./compte.php" ><input class="btn btn-danger" value="Annuler" style="width:110px;" /></a>
					</div>
		</form>
		<!-- Fin du formulaire ETUDIANT -->
		
		</div>
	<?php } ?>
    </div>
</div>
<?php
	include('footer.php');
?>