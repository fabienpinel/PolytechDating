<?php 
	session_start(); 
	$encours="contact";
	include("header.php") 
?>
	
	<div class="jumbotron">
      <div class="container">

		<div id="formulaire">
		
			<form data-toggle="validator" class="form-horizontal" role="form" action="envoimail.php" method="post">
  				<div class="form-group row" >

					<!-- Nom -->
					<div class="form-group">
					<label for="nom" class="col-sm-3 control-label">Nom</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" required/>
					</div>
					</div>

					<!-- Prénom -->
					<div class="form-group">
					<label for="prenom" class="col-sm-3 control-label">Pr&eacute;nom</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" required/>
					</div>
					</div>

					<!-- EMAIL -->
					<div class="form-group">
					<label for="mail" class="col-sm-3 control-label">E-mail</label>
					<div class="col-sm-9">	
						<input type="email" class="form-control" name="mail" id="mail" placeholder="E-mail" required/>
					</div>
					</div>

					<!-- Message -->
					<div class="form-group">
					<label for="message" class="col-sm-3 control-label">Message</label>
					<div class="col-sm-9">
						<textarea name="message" id="message" class="form-control" placeholder="Message" rows="10" required></textarea>
					</div>
					</div>

					<!-- Envoi ou remise a zero -->
					<div style="float: right;">
						<input class="btn btn-primary" name="send" type="submit" value="Envoyer" />
						<input class="btn btn-default" name="reset" type="reset" value="Remettre &agrave; z&eacute;ro" />
					</div>
				</div>
		</form>
		</div>
		<!-- Fin du formulaire -->
		
		</div>
	</div>
	
	<?php include("footer.php") ?>