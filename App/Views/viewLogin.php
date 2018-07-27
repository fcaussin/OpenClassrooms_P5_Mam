<!-- TITRE DE LA PAGE -->
<?php $this->title = "Connexion"; ?>

<!-- MAIN -->
<div class="container">
  <div class="section">
    <div class="row center">
      <h4>Se connecter</h4>
      <!-- Affiche un message d'erreur si besoin -->
      <p class="red-text"><?= $errorLogin ?></p>


      <!-- FORMULAIRE DE CONNEXION -->

      <form class="col s12" action="index.php?action=userLogin" method="post">

        <!-- Nom d'utilisateur -->
        <div class="row">
          <div class="input-field col s12 m6 offset-m3">
            <input id="first_name" type="text" class="validate" name="username" required>
            <label for="first_name">Nom d'Utilisateur</label>
          </div>
        </div>

        <!-- Mot de passe -->
        <div class="row">
          <div class="input-field col s12 m6 offset-m3">
            <input id="password" type="password" class="validate" name="password" required>
            <label for="password">Mot de passe</label>
          </div>
        </div>

        <!-- Bouton Valider et Effacer -->
        <div class="row">
          <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Valider</button>
          <button class="btn waves-effect waves-light deep-orange lighten-2" type="reset" name="action">Effacer</button>
        </div>
      </form>
    </div>
  </div>
</div>
