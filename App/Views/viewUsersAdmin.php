<!-- TITRE DE LA PAGE -->
<?php $this->title = "Liste des utilisateurs" ?>

<!-- MAIN -->

<div class="container">
  <div class="row">
    <div class="col s12 center">
      <h4>Gestion des utilisateurs</h4>
      <br />
    </div>

    <!-- Liste des utilisateurs -->
    <div class="col s12 m6 offset-m3">
      <ul class="collection ">

      <!-- Pour chaque utilisateur -->
      <?php foreach ($user as $user): ?>
        <li class="collection-item">


          <!-- AFFICHE L'UTILISATEUR -->

          <div><?= $user['username']?>
            <!-- Affiche (admin) SI l'utilisateur est un admin -->
            <?php if ($user['admin'] == 1): ?>
              (admin)
            <?php endif; ?>
            <!-- LIEN POPUP SUPPRESSION -->
            <a href="#modal<?= $user['id'] ?>" class="secondary-content modal-trigger"><i class="material-icons small">delete_forever</i></a>
          </div>


          <!-- POPUP: SUPPRESSION D'UN UTILISATEUR -->

          <div id="modal<?=$user['id']?>" class="modal center">
            <div class="modal-content">
              <h4>Suppression</h4>

              <!-- SI l'utilisateur essaye de supprimer son compte affiche un message d'erreur -->
              <?php if ($_SESSION['id'] == $user['id']): ?>
                <p class="red-text">Vous ne pouvez pas supprimer votre compte</p>

              <!-- SINON affiche le bouton supprimer -->
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
            </div>
          </div>
        </li>
      <?php endforeach; ?>

      <!-- LIEN POPUP CREATION UTILISATEUR -->
      <li class="collection-item blue-text text-lighten-1"><div>Créer un utilisateur<a href="#popup" class="secondary-content modal-trigger"><i class="material-icons small">add</i></a></div>


        <!-- POPUP : CREATION D'UN UTILISATEUR -->

        <div id="popup" class="modal">
          <div class="modal-content">
            <h4 class="deep-orange-text text-lighten-2 center">Création d'un utilisateur:</h4>


            <!-- FORMULAIRE DE CREATION D'UN UTILISATEUR -->

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

    <!-- Lien Retour page d'accueil -->
    <div class="col s12 m6 offset-m3 center">
      <br />
      <a href="index.php?action=login" class="collection-item blue-text text-lighten-1">Retour</a>
    </div>
  </div>
</div>
