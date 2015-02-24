<?php 
/**
 * \file      test_bdd.php
 * \author    Fabien Pinel
 * \version   1.0
 * \date      24 Février 2015
 * \brief     Page de test de la connexion à la BDD
 * \details   
 */
include("header.php");
$bdd = connect_database();
include("footer.php");
?>