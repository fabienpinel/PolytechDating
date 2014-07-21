<?php 
  include('function.php');
 ?>
<!--
  Site développé par Amir Ben Slimane et Fabien Pinel
-->
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="/images/icon.ico" />

    <title>Polytech Dating 2014</title>

    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css" />
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
          <a class="navbar-brand" href="#"><img src="images/logo.png" /></a>
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar">Accueil</span>
            <span class="icon-bar">Mon compte</span>
            <span class="icon-bar">Entreprises</span>
             <span class="icon-bar">Contact</span>
          </button>

          <div class="navbar-collapse collapse" id="menuTop">
            <ul class="nav navbar-nav" id="listeMenu">
              <li class="active"><a href="#">Accueil</a></li>
              <li ><a href="#">Mon compte</a></li>
              <li ><a href="#">Entreprises</a></li>
              <li ><a href="#">Contact</a></li>
            </ul>
          </div>

        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" id="loginForm">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control input-sm ">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control input-sm" style="width: 85px;">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
  </div>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Polytech Dating édition 2014 !</h1>
        <br />
        <div id="long-desc">
          <p>Le Dating Polytech est réalisé sous la forme bien connue d'un Job Dating qui permet aux recruteurs et candidats d'échanger et initier une première prise de contact, ils peuvent se recontacter pour un second entretien plus approfondi par la suite.</p>
          <p>Le planning du Dating Polytech est organisé à l'avance. Chaque candidat est préalablement inscrit sur un créneau horaire précis avec une ou plusieurs entreprises. La durée totale de l'entretien est de 20 minutes.</p>
          <br/>
          <b>Trouver un stage ou un futur emploi</b>
          <p>L'échange professionnel sera de <strong>15 minutes</strong>, temps durant lequel le candidat pourra se présenter, présenter son projet professionnel (métier, type d'entreprise, secteur géographique...) puis donnera son CV à l'entreprise pour échanger sur les atouts de sa candidature. <strong>Les 5 minutes suivantes seront consacrées aux conseils prodigués par le ou les recruteurs à l'élève.</strong></p>
          <br/>
          <u>Elèves participants</u>
          <p>150 élèves ingénieurs de 5ème année et Master 2 dans le domaine de l'informatique, l'électronique, IMAFA (Informatique et Mathématiques Appliquées à la Finance et l'Assurance).</p>
          <br/>
          <u>Entreprises participantes</u>
          <p>Retrouvez toutes les entreprises présentent lors de l'évènement dans l'onglet <a href="./entreprises.php">Entreprises</a>.</p>

        <p><a class="btn btn-primary btn-lg" role="button">Je m'inscris »</a></p>
      </div>
      </div>
    </div>

    <div class="container" >
      <div class="row" id="vignettes">
        <div class="col-md-5">
          <h2 id="vignette-inscription">Elèves</h2>
          <p class="vignette-desc">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p id="vignette-inscription"><a class="btn btn-success" href="#" role="button">Je m'inscris</a></p>
        </div>
        <div class="col-md-5">
          <h2 id="vignette-inscription">Entreprises</h2>
          <p class="vignette-desc" >Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p id="vignette-inscription"><a class="btn btn-success" href="#"  role="button">Je m'inscris</a></p>
       </div>
      </div>

      <hr>

      <footer>
        <p>© Polytech Nice 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  

</body></html>