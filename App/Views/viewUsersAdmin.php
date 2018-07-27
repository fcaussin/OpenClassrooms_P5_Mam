<!-- TITRE DE LA PAGE -->
<?php $this->title = "Liste des utilisateurs" ?>

<!-- MAIN -->

  <div class="container">
    <div class="row">
      <div class="col s12 center">
        <h4>Gestion des utilisateurs</h4>
        <br />
      </div>

      <div class="col s12 m6 offset-m3">
        <ul class="collection ">

        <?php foreach ($user as $user): ?>
          <li class="collection-item"><div><?= $user['username']?>
            <?php if ($user['admin'] == 1): ?>
              (admin)
            <?php endif; ?><a href="#modal<?= $user['id'] ?>" class="secondary-content modal-trigger"><i class="material-icons small">delete_forever</i></a></div>

            <div id="modal<?=$user['id']?>" class="modal center">
              <div class="modal-content">
                <h4>Suppression</h4>

                <?php if ($_SESSION['id'] == $user['id']): ?>
                  <p class="red-text">Vous ne pouvez pas supprimer votre compte</p>

                <?php else: ?>

                  <p>Voulez-vous supprimer l'utilisateur <?= $user['username']?></p>

                  <!-- FORMULAIRE SUPPRESSION D'UN UTILISATEUR -->
                  <form action="index.php?action=deleteUser" method="post">
                    <!-- Données envoyées caché pour vérification -->
                    <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                    <!-- Bouton valider et annuler -->
                    <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Supprimer</button>
                    <a href="#!" class="modal-close btn waves-effect waves-light deep-orange lighten-2">Annuler</a>
                  </form>

                <?php endif; ?>
            </div></li>

        <?php endforeach; ?>
        <li class="collection-item blue-text text-lighten-1"><div>Créer un utilisateur<a href="#popup" class="secondary-content modal-trigger"><i class="material-icons small">add</i></a></div>

          <!-- Popup formulaire de création -->
          <div id="popup" class="modal">
            <div class="modal-content">
              <h4 class="deep-orange-text text-lighten-2 center">Création d'un utilisateur:</h4>
              <!-- FORMULAIRE DE CREATION DE L'ENFANT -->
              <form class="col s12" action="index.php?action=createUser" method="post">

                <div class="row">
                  <!-- Nom Utilisateur -->
                  <div class="input-field col s12 m6">
                    <input id="userame" name="username" type="text" class="validate" required />
                    <label for="username">Nom d'utilisateur</label>
                  </div>
                  <!-- Mot de passe -->
                  <div class="input-field col s12 m6">
                    <input id="password" name="password" type="text" class="validate" required />
                    <label for="password">Mot de passe</label>
                  </div>
                </div>

                <div class="row">
                  <!-- Rôle -->
                  <div class="input-field col s6 m6">
                    <select name="admin" required>
                      <option value="" disabled selected>Sélectionnez un rôle</option>
                      <option value="">Parent</option>
                      <option value="1">Administrateur</option>
                    </select>
                  </div>
                </div>

                <!-- Bouton Valider -->
                <div class="row center">
                  <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Valider</button>
                  <button class="btn waves-effect waves-light modal-close deep-orange lighten-2" type="reset">Annuler</button>
                </div>
              </form>
            </div>
          </div>
        </li></ul>
      </div>

      <div class="col s12 m6 offset-m3">
        <a href="index.php?action=login" class="collection-item blue-text text-lighten-1">Retour</a>
      </div>

    </div>
  </div>
