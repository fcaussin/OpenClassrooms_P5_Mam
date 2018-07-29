<!-- TITRE DE LA PAGE -->
<?php $this->title = "La M.A.M. des Poussins"; ?>

<!-- MAIN -->
<div id="index-banner" class="parallax-container">
  <div class="section no-pad-bot">
    <!-- Texte à l'intérieur de la première image -->
    <div class="container">
      <br><br>
      <h1 class="header center deep-orange-text text-lighten-2">La M.A.M. des Poussins</h1>
      <div class="row center">
        <h5 class="header col s12 light">La Maison d'Assistantes Maternelles des Poussins située à Opio, accueille vos enfants et offre tout le confort nécessaire pour qu'ils se sentent "comme à la maison"</h5>
      </div>
      <!-- Bouton de la première image -->
      <div class="row center login-btn">
        <a href="index.php?action=login" id="login-button" class="btn-large waves-effect waves-light deep-orange lighten-2">

          <!-- SI l'utilisateur n'est pas connecté Bouton se Connecter -->
          <?php if (empty($_SESSION)): ?>
            Se connecter
          <!-- SINON Bouton accès à l'accueil du compte -->
          <?php else: ?>
            Mon compte
          <?php endif; ?>
        </a>
      </div>
      <br><br>
    </div>
  </div>

  <!-- Image 1 -->
  <div class="parallax"><img src="img/enfant1.jpg" alt="Photo roupe d'enfants"></div>
</div>

<!-- Icone section -->
<div class="container">
  <div class="section">
    <div class="row">

      <!-- Première icone -->
      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center deep-orange-text text-lighten-2"><i class="material-icons">home</i></h2>
          <h5 class="center">C'est quoi une M.A.M.</h5>

          <p class="light description">Une MAM (Maison d'Assistantes Maternelles) est une structure d’accueil des jeunes enfants, dans laquelle jusqu’à quatre assistants maternels peuvent se regrouper afin de travailler ensemble. Grâce à leur agrément individuel, chaque assistant maternel peut accueillir simultanément jusqu’à quatre enfants maximum, dans un local dédié et sécurisé.</p>
        </div>
      </div>

      <!-- Deuxième icone -->
      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center deep-orange-text text-lighten-2"><i class="material-icons">child_friendly</i></h2>
          <h5 class="center">Les avantages</h5>

          <p class="light description">La Maison d'Assistantes Maternelles est entièrement dédiée à l'accueil des enfants et favorise un passage plus souple du milieu famillial vers la petite collectivité, en mettant en pratique une approche respectueuse, dynamique et adaptée à chaque enfant et famille. Elle offre également un large choix d'activités et de jeux adaptés à tous les âges aussi bien en intérieur qu'en extérieur.</p>
        </div>
      </div>

      <!-- Troisième icone -->
      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center deep-orange-text text-lighten-2"><i class="material-icons">extension</i></h2>
          <h5 class="center">Notre application</h5>

          <p class="light description">La M.A.M. des Poussins vous propose de suivre le déroulement de la journée de votre enfant grâce à notre application. Connectez-vous et accédez à tout moment aux comptes-rendus de votre enfant et suivez son évolution jour après jour. Chaque compte-rendu possède une notation simple qui vous permet de voir d'un coup d'oeil l'appréciation du déroulement de la journée de votre enfant.</p>
        </div>
      </div>
    </div>
  </div>
</div>
