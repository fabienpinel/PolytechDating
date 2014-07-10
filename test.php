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