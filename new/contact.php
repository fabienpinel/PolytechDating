<?php 
	session_start(); 
	$encours="contact";
	include("header.php") 
?>
	
	<div id="contenu">

		<div id="formulaire">
		
		<!-- D�but du formulaire -->
		<table>
			<form action="envoimail.php" method="post" onSubmit="return verifForm(this, 1)">
		
			<!-- Nom -->
			<tr>
				<td>
					<label for="nom">Nom</label>
				</td>
				<td>
					<input type="text" style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="nom" id="nom" />
				</td>
			</tr>

			<!-- Pr�nom -->
			<tr>
				<td>
					<label for="prenom">Pr&eacute;nom</label>
				</td>
				<td>
					<input type="text" style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="prenom" id="prenom" />
				</td>
			</tr>

			<!-- E-mail -->
			<tr>
				<td>
					<label for="mail">E-mail</label>
				</td>
				<td>
					<input type="text" style="width:150px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 20px; padding-left:5px;" name="mail" id="mail" />@polytech.unice.fr
				</td>
			</tr>

			<!-- Promotion -->
			<tr>
				<td>
					<label for="promotion">Votre promotion</label>
				</td>
				<td>
					<select style="width:300px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 25px" name="promotion" id="promotion">
						<option value=""></option>
						<option value="SI5">INGENIEUR INFORMATIQUE</option>
						<option value="ELEC5">INGENIEUR ELECTRONIQUE</option>
						<option value="IMAFA">IMAFA</option>
						<option value="IFI">M2 IFI</option>
						<option value = "Autre"> Autre (merci de pr&eacute;ciser dans le message)</option>
					</select>
				</td>
			</tr>

			<!-- Message -->
			<tr>
				<td>
					<label for="message">Message</label>
				</td>
				<td>
					<textarea name="message" id="message" style="width:500px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: #c9c7c7; border: 1px solid #656565; height : 100px; padding-left:5px;"></textarea>
				</td>
			</tr>

			<!-- Envoi ou remise � z�ro -->
			<tr>
				<td>
				</td>
				<td>
					<div style="text-align: right">
					<input class="submit2" name="send" type="submit" value="Envoyer" /><input class="submit22" name="reset" type="reset" value="Remettre &agrave; z&eacute;ro" />
					</div>
				</td>
			</tr>
		</form>

		</table>
		<!-- Fin du formulaire -->
		
		</div>
	</div>
	
	<?php include("footer.php") ?>

</body>
</html>