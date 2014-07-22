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
		<!-- Debut du formulaire -->
			<form role="form" class="form-horizontal" id="formPhaseI" action="creation_compte.php" method="post" onSubmit="return verifForm(this, 0)" enctype="multipart/form-data">
			
					<!-- Nom -->
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nom</label>
						<div class="col-sm-10">
							<input type="text" name="nom" id="nom" class="form-control" />
						</div>
					</div>
					<!-- Pr�nom -->
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label">Pr&eacute;nom</label>
						<div class="col-sm-10">
							<input type="text" name="prenom" id="prenom" class="form-control" />
						</div>
					</div>
					<!-- Promotion -->
					<div class="form-group">
						<label for="promotion" class="col-sm-2 control-label">Promotion</label>
						<div class="col-sm-10">
							<select name="promotion" id="promotion"  onchange="changerspe()" class="form-control">
								<option value=""></option>
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
							<label for="parcoursMAM" class="col-sm-2 control-label">Parcours</label>
							<div class="col-sm-10">	
								<select name="parcoursMAM" id="parcoursMAM" class="form-control" >
									<option value=""></option>
									<option value="IMAFA">IMAFA</option>
									<option value="INUM">INUM</option>
									<option value="VIM">VIM</option>
								</select>
							</div>
					</div>
					<!-- Parcours -->
					<div class="form-group" id="parcoursSI" style="display: none;">
							<label for="parcoursSI" class="col-sm-2 control-label">Parcours</label>
							<div class="col-sm-10">
								<select name="parcoursSI" id="parcoursSI" class="form-control" >
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
							</div>
					</div>
					<!-- Parcours -->
					<div class="form-group" id="parcoursELEC" style="display: none;">
							<label for="parcoursELEC" class="col-sm-2 control-label">Parcours</label>
							<div class="col-sm-10">
								<select name="parcoursELEC" id="parcoursELEC" class="form-control" >
									<option value=""></option>
									<option value="GSE">GSE</option>
									<option value="TNS">TNS</option>
									<option value="CCS">CCS</option>
									<option value="TR">TR</option>
								</select>
							</div>
					</div>
			
					<!-- E-mail -->
					<div class="form-group">
						<label for="mail" class="col-sm-2 control-label">E-mail</label>
						<div class="col-sm-10">
							<input type="text" name="mail" id="mail"class="form-control" /> @polytech.unice.fr
						</div>
					</div>
					<!-- CV input -->
					<div class="form-group">
						<label for="cv" class="col-sm-2 control-label">CV (en .pdf)</label>
				 		<div class="col-sm-10">
				 			<input type="hidden" name="MAX_FILE_SIZE" value="2097152" class="form-control" />
							<input type="file" name="cv" id="cv"/>
						</div>
					</div>
					<!-- 2 mots caractéristiques  -->
					<div class="form-group">
						<label for="motscles" class="col-sm-4 control-label">2 mots qui vous caractérisent (libre expression)</label>
				 		<div class="col-sm-4">
				 			<input type="text" name="motcles1" id="motcles1" class="form-control" />
				 		</div>
				 		<div class="col-sm-4">
				 			<input type="text" name="motcles2" id="motcles2" class="form-control" />
						</div>
					</div>
					<!-- Mot de passe -->
					<div class="form-group">
						<label for="pass" class="col-sm-2 control-label">Mot de passe</label>
						<div class="col-sm-10">
							<input type="password" name="pass" id="pass" class="form-control" />
						</div>
					</div>
					<!-- Confirmation -->
					<div class="form-group">
						<label for="pass2" class="col-sm-2 control-label">Confirmation</label>
						<div class="col-sm-10">
							<input type="password" name="pass2" id="pass2" class="form-control" />
						</div>
					</div>
					<!-- Envoi ou remise � z�ro -->
					<div style="text-align: right">
						<input class="submit2 btn btn-primary" name="send" type="submit" value="Envoyer" />
						<input class="submit22 btn btn-primary" name="reset" type="reset" value="Remettre &agrave; z&eacute;ro" />
					</div>
		</form>
		<!-- Fin du formulaire -->
		
		</div>
	</div>
		
	<?php	
	}
		?>
	</div><!-- container -->
</div><!-- jumbotron -->
	
<?php include("footer.php") ?>