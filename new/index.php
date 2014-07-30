<?php
  session_start(); 
  $encours="index"; 
  include("header.php");
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
          <div class="alert alert-danger" role="alert">
            Ce site est en développement !
          </div>
        <h1>Polytech Dating édition 2014 !</h1>
        <br />
        <div id="long-desc">
          <p>Le Dating Polytech est réalisé sous la forme bien connue d'un Job Dating qui permet aux recruteurs et candidats d'échanger et initier une première prise de contact, ils peuvent se recontacter pour un second entretien plus approfondi par la suite.</p>
          <p>Le planning du Dating Polytech est organisé à l'avance. Chaque candidat est préalablement inscrit sur un créneau horaire précis avec une ou plusieurs entreprises. La durée totale de l'entretien est de 20 minutes.</p>
          <br/>
          <h2>Trouver un stage ou un futur emploi</h2>
          <p>L'échange professionnel sera de <strong>15 minutes</strong>, temps durant lequel le candidat pourra se présenter, présenter son projet professionnel (métier, type d'entreprise, secteur géographique...) puis donnera son CV à l'entreprise pour échanger sur les atouts de sa candidature. <strong>Les 5 minutes suivantes seront consacrées aux conseils prodigués par le ou les recruteurs à l'élève.</strong></p>
          <br/>
          <h2>Elèves participants</h2>
          <p>150 élèves ingénieurs de 5ème année et Master 2 dans le domaine de l'informatique, l'électronique, IMAFA (Informatique et Mathématiques Appliquées à la Finance et l'Assurance).</p>
          <br/>
          <h2>Entreprises participantes</h2>
          <p>Retrouvez toutes les entreprises présentent lors de l'évènement dans l'onglet <a href="./entreprises.php">Entreprises</a>.</p>

        <p><a class="btn btn-primary btn-lg" role="button" href="./inscription.php">Je m'inscris »</a></p>
      </div><!-- long desc -->
      </div><!-- container -->
    </div><!-- jumbotron -->

    <div class="container" >
      <div class="row" id="vignettes">
        <div class="col-md-5">
          <h2 id="vignette-inscription">Elèves</h2>
          <p class="vignette-desc">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p id="vignette-inscription"><a class="btn btn-success" href="./inscription.php?type=etudiant" role="button">Je m'inscris</a></p>
        </div>
        <div class="col-md-5">
          <h2 id="vignette-inscription">Entreprises</h2>
          <p class="vignette-desc" >Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p id="vignette-inscription"><a class="btn btn-warning" href="./inscription.php?type=entreprise"  role="button">Je m'inscris</a></p>
       </div>
      </div>
    </div>  <!-- container -->
      <hr>
      

      
  <?php include("footer.php"); ?>