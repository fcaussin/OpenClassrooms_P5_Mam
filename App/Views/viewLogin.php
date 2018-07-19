<!-- TITRE DE LA PAGE -->
<?php $this->title = "Connexion"; ?>

<!-- MAIN -->

<div class="container">
  <div class="section">
    <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h4>Se connecter</h4>
        </div>
        <form class="col s12 offset-s2">
          <div class="row">
            <div class="input-field col s9 center">
              <input id="first_name" type="text" class="validate" required>
              <label for="first_name">Nom d'Utilisateur</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s9 center">
              <input id="password" type="password" class="validate" required>
              <label for="password">Password</label>
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
