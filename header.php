<?php 
/**
 * \file      header.php
 * \author    Fabien Pinel
 * \version   1.0
 * \date      24 Février 2015
 * \brief     Header du site. Fichier contenant la première partie de la page avec notamment le menu.
 *
 * \details  
 */

include('function.php');
?>
<!--
  Site développé par Fabien Pinel (pinel.fabien@gmail.com - http://fabienpinel.com)
-->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Polytech Dating">
  <meta name="author" content="Fabien Pinel">
  <link rel="icon" type="image/png" href="_/images/favicon.png" />

  <title>Polytech Dating <?php echo getInfoSiteInformation("edition"); ?></title>

  <!-- Bootstrap core CSS -->
  <!--<link rel="stylesheet" href="_/css/bootstrap-3.2.0.css" />-->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="_/css/style.css" />
  <link rel="icon" type="image/png" href="/images/icon.ico" />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body>
      <div id="header">
        
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="./index.php"><img src="_/images/logo.png" id="mainLogo" /></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>


            <div class="navbar-collapse collapse" id="menuTop">
              <ul class="nav navbar-nav" role="menu" id="listeMenu">
                <li <?php if(isset($encours) && $encours == 'index'){echo 'class="active"';}    ?>><a href="./index.php"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                <li <?php if(isset($encours) && $encours == 'compte'){echo 'class="active"';}    ?>><a href="./compte.php"><span class="glyphicon glyphicon-user"></span> Mon compte</a></li>
                <li <?php if(isset($encours) && $encours == 'entreprises'){echo 'class="active"';}    ?>><a href="./entreprises.php"><span class="glyphicon glyphicon-th"></span> Entreprises</a></li>
                <li <?php if(isset($encours) && $encours == 'contact'){echo 'class="active"';}    ?>><a href="./contact.php"><span class="glyphicon glyphicon-send"></span> Contact</a></li>
              </ul>
            </div>

            <?php
            if (isset($_SESSION['id']) AND isset($_SESSION['mail'])){
			  //connected
              ?>
              <div class="navbar-collapse collapse">
                <div class="navbar-form navbar-right" id="connected" >
                  <p>Bienvenue <?php 
                    if(isset($_SESSION['prenom'])){
                     echo $_SESSION['prenom'];
                   }else{
                    echo $_SESSION['nom'];
                  }
                  ?> !</p>
                  <p><a href="deconnexion.php">(Se deconnecter)</a></p>
                </div>
              </div>
              <?php 
            }else{ 
			//not connected
              ?>
              <div class="navbar-collapse collapse" >
                <form class="navbar-form navbar-right loginForm" id="loginFields" role="form" action="connexion.php" method="post" onSubmit="return verifForm(this, 2)">
                  <div class="form-group">
                    <input type="text" placeholder="Email" class="form-control input-sm" name="mail" id="mail" style="width: 110px;" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="pass" id="pass" placeholder="Mot de passe" class="form-control input-sm" style="width: 95px;" required>
                  </div>

                  <button type="submit" class="btn btn-primary">Connexion</button>
                </form>
                <a href="./connexion.php" id="loginButton" class=" navbar-right loginForm"><button class="btn btn-primary">Connexion</button></a>
              </div><!--/.navbar-collapse -->
              <?php } ?>
            </div>
          </div>
        </div>