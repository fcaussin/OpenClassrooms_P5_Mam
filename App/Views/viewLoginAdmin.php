<!-- TITRE DE LA PAGE -->
<?php $this->title = "Modifier mot de passe "; ?>

<!-- MAIN -->

<div class="container">
  <div class="section">
    <div class="row center">
      <h4>Modifiez votre mot de passe : <span class="deep-orange-text text-lighten-2"><?= $_SESSION['username'] ?></span></h4>
      <p class="red-text"><?= $updatePassword ?></p>
      <form class="col s12" action="index.php?action=updateLogin" method="post">

        <div class="row">
          <div class="input-field col s12 m6 offset-m3">
            <input id="oldPassword" type="password" class="validate" name="oldPassword" required>
            <label for="oldPassword">Votre mot de passe</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m6 offset-m3">
            <input id="password1" type="password" class="validate" name="password1" required>
            <label for="password1">Nouveau mot de passe</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m6 offset-m3">
            <input id="password2" type="password" class="validate" name="password2" required>
            <label for="password2">Confirmez  votre nouveau mot de passe</label>
          </div>
        </div>

        <div class="row">
          <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Valider</button>
          <button class="btn waves-effect waves-light deep-orange lighten-2" type="reset" name="action">Effacer</button>
        </div>
      </form>
    </div>
  </div>
</div>
