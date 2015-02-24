 <?php
/**
 * \file      footer.php
 * \author    Fabien Pinel
 * \version   1.0
 * \date      24 Février 2015
 * \brief     Footer du site, informations de contact, adresse. 
 *
 * \details  
 */
 ?>
      <footer>
        <p>© Polytech Nice 2014 - 930 Route des Colles - 06903 Sophia Antipolis</p>
        <p>Contact : <?php echo getMailContact(); ?></p>
      </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <?php
    if(isset($encours) && (($encours == 'inscription') || ($encours == 'contact') || ($encours == 'modifier_compte') || ($encours == 'rdv') || ($encours == 'heure'))) {
     echo'<script src="./_/js/validator.js"></script>';
   }
   ?>
 </body>
 </html>