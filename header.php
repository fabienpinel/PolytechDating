<?php include('function.php') ?>
<!--
	Site développé par Amir Ben Slimane et Fabien Pinel
-->
<global>
<div id="header">
	<div class="logo" style="margin-left: 10px;" onclick="document.location='index.php'">
	</div>
	<div class="deco">
	<?php
		if (isset($_SESSION['id']))
			echo 'Bienvenue ' .$_SESSION['nom']. ' ' .$_SESSION['prenom']. ' <a href="deconnexion.php">(Se deconnecter)</a>';
		?>
	</div>
	<div class="edition">
		Edition 2013
		<div class="lieu">
		Le Jeudi 5 décembre de 14h à 18h, au campus Templiers de Polytech'Nice-Sophia.
		<?php tempsRestantEvenement() ?>
		</div>
	</div>
</div>
<!--<center><p style="color:red;font-size:15px;">Fin des prises de rendez-vous!</p></center>-->
<div id="menu">
	<table>
	<tr id="liens">
		
			<td <?php if($encours == 'index'){echo ' class="encours "';}    ?> onclick="document.location='index.php'">Accueil</td>
			<td <?php if($encours == 'inscription'){echo ' class="encours" ';}    ?> onclick="document.location='inscription.php'">Inscription</td>
			<td <?php if($encours == 'moncompte'){echo ' class="encours" ';}    ?> onclick="document.location='moncompte.php'">Mon compte</td>
			<td <?php if($encours == 'entreprises'){echo ' class="encours" ';}    ?> onclick="document.location='entreprises.php'">Entreprises</td>
			<td  <?php if($encours == 'contact'){echo ' class="encours" ';}    ?> onclick="document.location='contact.php'">Contact</td>
	</tr></table>
	
</div>
