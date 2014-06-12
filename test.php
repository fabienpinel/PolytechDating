<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Polytech'Dating</title>
	<link rel="stylesheet" href="style.css" />
	<script type="text/javascript" src="verifForm.js"></script>
</head>
<body>

	<?php include("header.php") ?>
	
	<?php
	try
	{
			$bdd = new PDO('mysql:host=...;dbname=...', '...', '...');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	
	
	include("footer.php") ?>

</body>
</html>