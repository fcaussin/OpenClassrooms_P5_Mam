<!-- TITTRE DE LA PAGE -->
<?php $this->title = "Erreur sur la page"; ?>


<!-- MAIN -->
<div class="container">
  <div class="section">

    <div class="row">
      <div class="col s12 center">
        <br><br>
        
        <!-- Bouton de retour à la page d'accueil -->
        <a class="btn-floating btn-large red pulse" href="index.php"><i class="large material-icons">report_problem</i></a>

        <!-- Message d'erreur -->
        <h5>Une erreur est survenue :</h5>
        <h6 class="center-align light"><?= $msgError ?></h6>
      </div>
    </div>
  </div>
</div>
