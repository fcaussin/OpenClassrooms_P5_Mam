<!-- TITRE DE LA PAGE -->
<?php $this->title = "Connexion"; ?>

<!-- MAIN -->

<div class="container">
  <div class="section">
    <div class="row">
        <div class="col s12 center">
          <h4>Se connecter</h4>
          <p class="red-text"><?= $errorLogin ?></p>
        </div>
        <form class="col s12 offset-s2" action="index.php?action=userLogin" method="post">
          <div class="row">
            <div class="input-field col s9 center">
              <input id="first_name" type="text" class="validate" name="username" required>
              <label for="first_name">Nom d'Utilisateur</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s9 center">
              <input id="password" type="password" class="validate" name="password" required>
              <label for="password">Mot de passe</label>
            </div>
          </div>
          <div class="row">
              <div class="col s1">
                <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Valider</button>
              </div>
              <div class="col s3 m2 l1">

              </div>
              <div class="col s1">
                <button class="btn waves-effect waves-light deep-orange lighten-2" type="reset" name="action">Effacer</button>
              </div>

          </div>
        </form>
      </div>
  </div>
</div>
