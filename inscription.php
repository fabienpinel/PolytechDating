<?php session_start(); $encours="inscription"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Polytech'Dating - Inscription</title>
	<script type="text/javascript" src="verifForm.js"></script>
	<link rel="stylesheet" href="style.css" />
	<link rel="icon" type="image/png" href="/images/icon.ico" />
</head>
<body>

	<?php include("header.php") ?>
	
	<div id="contenu">
	<?php if (isset($_SESSION['id']) AND isset($_SESSION['mail']))
	{
		echo "<p>Vous êtes connecté.</p>";
	}else{ ?>
		Les inscriptions sont fermées pour le moment. 
		<?php formulaire('compteCree') ?>
	<?php	
	}
		?>
		
	</div>
	
	<?php include("footer.php") ?>

</body>
</html>