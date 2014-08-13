<?php 
	session_start(); 
	$encours="inscription"; 
	include("header.php");
?>

<div class="jumbotron">
    <div class="container">

	<?php if (isset($_SESSION['id']) AND isset($_SESSION['mail']))
	{
		echo "<p>Vous êtes connecté.</p>";
	}else{ ?>
	<div class="alert alert-danger" role="alert">
		Les inscriptions sont fermées pour le moment. 
	</div>
		<?php 
			if(!isset($_GET['type'])){
				//le type est indéfini
				//on affiche le choix de type (etudiant // entreprise)
				?>
				<div class="row" id="choixType">
					<div class="col-sm-5">
						<a href='?type=etudiant'>
						<button type="button" class="btn btn-success btn-lg">Je suis étudiant</button>
						</a>
					</div>
					<div class="col-sm-5">
						<a href='?type=entreprise'>	
						<button type="button" class="btn btn-warning btn-lg">Je suis une entreprise</button>
						</a>
					</div>
				</div>
				<?php
			}else{
				if($_GET['type'] == 'etudiant'){
		
					$si = array('IAM', 'IMAFA', 'IHM', 'KIS', 'UN', 'VIM', 'AL', 'CSSR');
					$elec = array('GSE','TNS', 'CCS', 'TR');
		?>

	

		<div id="inscription">
		<!-- Debut du formulaire ETUDIANT -->
			<form data-toggle="validator" role="form" class="form-horizontal" id="formPhaseI" action="creation_compte_etudiant.php" method="post" enctype="multipart/form-data">
			
					<!-- Nom -->
					<div class="form-group">
						<label for="nom" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required/>
						</div>
					</div>
					<!-- Pr�nom -->
					<div class="form-group">
						<label for="prenom" class="col-sm-4 control-label">Pr&eacute;nom</label>
						<div class="col-sm-8">
							<input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" required/>
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
					<div class="form-group" id="parcours">

					</div>


			
					<!-- EMAIL -->
					<div class="form-group">
						<label for="mail" class="col-sm-4 control-label">E-mail</label>
						<div class="col-sm-8">	
							<input type="email" class="form-control" name="mail" id="mail" placeholder="E-mail (@polytech.unice.fr)" required/>
						</div>
					</div>
					<!-- CV input -->
					<div class="form-group">
						<label for="cv" class="col-sm-4 control-label">CV (en .pdf)</label>
				 		<div class="col-sm-8">
				 			<input type="hidden" name="MAX_FILE_SIZE" value="2097152" class="form-control" />
							<input type="file" name="cv" id="cv" required/>
						</div>
					</div>
					<!-- 2 mots caractéristiques  -->
					<div class="form-group">
						<label for="motscles" class="col-sm-4 control-label">2 mots qui vous caractérisent (libre expression)</label>
				 		<div class="col-sm-4">
				 			<input type="text" name="motcles1" id="motcles1" placeholder="Mot clef" class="form-control" required/>
				 		</div>
				 		<div class="col-sm-4">
				 			<input type="text" name="motcles2" id="motcles2" placeholder="Mot clef" class="form-control" required/>
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
					<!-- Envoi ou remise � z�ro -->
					<div style="text-align: right">
						<input class="submit2 btn btn-primary" name="send" type="submit" value="Envoyer" />
						<input class="submit22 btn btn-default" name="reset" type="reset" value="Remettre &agrave; z&eacute;ro" />
					</div>
		</form>
		<!-- Fin du formulaire ETUDIANT -->
		
		</div>
		
	<?php
		}else if($_GET['type'] == 'entreprise'){
	?>
	
	<div id="inscription">
		<!-- Debut du formulaire ENTREPRISE -->
			<form data-toggle="validator" role="form" class="form-horizontal" id="formPhaseI" action="creation_compte_entreprise.php" method="post" enctype="multipart/form-data">
			
					<!-- Nom -->
					<div class="form-group">
						<label for="nom" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" name="nom" id="nom" class="form-control" placeholder="Nom de l'entreprise" required/>
						</div>
					</div>
													
					<!-- EMAIL -->
					<div class="form-group">
						<label for="mail" class="col-sm-4 control-label">E-mail</label>
						<div class="col-sm-8">	
							<input type="email" class="form-control" name="mail" id="mail" placeholder="E-mail" required/>
						</div>
					</div>
					<!-- Website -->
					<div class="form-group">
						<label for="website" class="col-sm-4 control-label">Website</label>
						<div class="col-sm-8">
							<input type="text" name="website" id="website" class="form-control" placeholder="Website" required/>
						</div>
					</div>
					<!-- Spécialité -->
					<div class="form-group">
						<label for="com" class="col-sm-4 control-label">Spécialité visée</label>
						<div class="col-sm-8">
							<input type="text" name="com" id="com" class="form-control" placeholder="Spécialité visée" required/>
						</div>
					</div>
					<!-- LOGO input -->
					<div class="form-group">
						<label for="logo" class="col-sm-4 control-label">Logo (image)</label>
				 		<div class="col-sm-8">
				 			<input type="hidden" name="MAX_FILE_SIZE" value="2097152" class="form-control" />
							<input type="file" name="logo" id="logo" required/>
						</div>
					</div>
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
						
					<!-- Envoi ou remise � z�ro -->
					<div style="text-align: right">
						<input class="submit2 btn btn-primary" name="send" type="submit" value="Envoyer" />
						<input class="submit22 btn btn-default" name="reset" type="reset" value="Remettre &agrave; z&eacute;ro" />
					</div>
		</form>
		<!-- Fin du formulaire -->
		
		</div>
	<?php	
		}	
	}//fin du else (isset(type))
}//fin du else (connecté)
		?>
	</div><!-- container -->
</div><!-- jumbotron -->
<script type="text/javascript"> 
			function changerspe(){ 
				var type = document.getElementById('promotion').options[document.getElementById('promotion').selectedIndex].value; 
				if(type == 'SI5' || type == 'IFI'){ 
					document.getElementById('parcours').innerHTML = '<label for="parcours" class="col-sm-4 control-label">Parcours</label><div class="col-sm-8"><select name="parcours" id="parcours" class="form-control" ><option value="" disabled selected>Sélectionnez votre parcours</option><option value="IAM">IAM</option><option value="IMAFA">IMAFA</option><option value="IHM">IHM</option><option value="KIS">KIS</option><option value="UN">UN</option><option value="VIM">VIM</option><option value="AL">AL</option><option value="CSSR">CSSR</option></select></div>';
				}else if(type == 'ELEC5'){ 
					document.getElementById('parcours').innerHTML='<label for="parcours" class="col-sm-4 control-label">Parcours</label>'
							+'<div class="col-sm-8">'
								+'<select name="parcours" id="parcours" class="form-control" >'
									+'<option value="" disabled selected>Sélectionnez votre parcours</option>'
									+'<option value="GSE">GSE</option>'
									+'<option value="TNS">TNS</option>'
									+'<option value="CCS">CCS</option>'
									+'<option value="TR">TR</option>'
								+'</select>'
							+'</div>';
				 
				}else if(type == 'MAM5'){ 
					document.getElementById('parcours').innerHTML='<label for="parcours" class="col-sm-4 control-label">Parcours</label>'
							+'<div class="col-sm-8">'
								+'<select name="parcours" id="parcours" class="form-control" >'
									+'<option value="" disabled selected>Sélectionnez votre parcours</option>'
									+'<option value="IMAFA">IMAFA</option>'
									+'<option value="INUM">INUM</option>'
									+'<option value="VIM">VIM</option>'
								+'</select>'
							+'</div>';
				} 
				else{
					document.getElementById('parcours').innerHTML='';
				}
			} 
			</script>
<?php include("footer.php") ?>