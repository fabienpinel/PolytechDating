<?php 
	session_start(); 
	$encours="inscription"; 
	include("header.php");
?>
	
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