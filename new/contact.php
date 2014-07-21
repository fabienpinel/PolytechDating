<?php 
	session_start(); 
	$encours="contact";
	include("header.php") 
?>
	
	<div class="jumbotron">
      <div class="container">

		<div id="formulaire">
		
			<form class="form-horizontal" role="form" action="envoimail.php" method="post" onSubmit="return verifForm(this, 1)">
  				<div class="form-group row" >

					<!-- Nom -->
					<div class="form-group">
					<label for="nom">Nom</label>
					<input type="text" class="form-control" name="nom" id="nom" />
					</div>

					<!-- Prénom -->
					<div class="form-group">
					<label for="prenom">Pr&eacute;nom</label>
					<input type="text" class="form-control" name="prenom" id="prenom" />
					</div>

					<!-- EMAIL -->
					<div class="form-group">
					<label for="mail">E-mail</label>
					<input type="text" class="form-control" name="mail" id="mail" />@polytech.unice.fr
					</div>

					<!-- Promotion -->
					<div class="form-group">
					<label for="promotion">Votre promotion</label>
					<select  name="promotion" id="promotion" class="form-control">
						<option value=""></option>
						<option value="SI5">INGENIEUR INFORMATIQUE</option>
						<option value="ELEC5">INGENIEUR ELECTRONIQUE</option>
						<option value="IMAFA">IMAFA</option>
						<option value="IFI">M2 IFI</option>
						<option value = "Autre"> Autre (merci de pr&eacute;ciser dans le message)</option>
					</select>
					</div>

					<!-- Message -->
					<div class="form-group">
					<label for="message">Message</label>
					<textarea name="message" id="message" class="form-control" ></textarea>
					</div>

					<!-- Envoi ou remise � z�ro -->
					<div>
						<input class="btn btn-primary" name="send" type="submit" value="Envoyer" />
						<input class="btn btn-primary" name="reset" type="reset" value="Remettre &agrave; z&eacute;ro" />
					</div>
				</div>
		</form>
		</div>
		<!-- Fin du formulaire -->
		
		</div>
	</div>
	
	<?php include("footer.php") ?>