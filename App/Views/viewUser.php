<!-- TITRE DE LA PAGE -->
<?php $this->title = "Accueil du compte: " . $_SESSION['username']; ?>

<!-- MAIN -->
<div class="container">
  <div class="section">
    <div class="row">
      <div class="col s12 center">
        <h4>Informations de votre/vos enfant(s)</h4>
        <p>Vous pouvez modifier les informations de votre/vos enfant(s), n'hésitez pas à les mettre à jour régulièrement. Vous avez accès également au dernier compte-rendu ou à l'historique des 30 derniers.</p>
      </div>

      <!-- Affiche une carte pour chaque enfants -->
      <?php foreach ($children as $children): ?>
        <div class="col s12 m6">
          <div class="card hoverable z-depth-2">
            <div class="card-content">

              <!-- Données de l'enfant -->
              <span class="card-title deep-orange-text text-lighten-2"><?= $children['childName'] . " " . $children['familyName']?></span>
              <p>
              Date de naissance : <?= $children['birthday_fr'] ?><br>
              Taille : <?= $children['height'] ?> cm<br>
              Poids : <?= $children['weight'] ?> kg</p>
              <br>

              <!-- Menus déroulants -->
              <ul class="collapsible popout">
                <!-- Informations -->
                <li class="active">
                  <div class="collapsible-header white-text deep-orange lighten-2">
                    <i class="material-icons">visibility</i>
                    Informations
                    <span class="badge white-text"><i class="material-icons">arrow_drop_down</i></span>
                  </div>
                  <div class="collapsible-body">
                    <?php if (!$children['note']): ?>
                      <p>Aucune informations</p>
                    <?php else: ?>
                      <p><?= $children['note'] ?></p>
                    <?php endif; ?>
                  </div>
                </li>
                <!-- Rapports -->
                <li>
                  <div class="collapsible-header white-text deep-orange lighten-2">
                    <i class="material-icons">assignment</i>
                    Rapports
                    <span class="badge white-text"><i class="material-icons">arrow_drop_down</i></span>
                  </div>
                  <div class="collapsible-body">
                      <div class="collection">
                        <a href="" class="collection-item black-text">Dernier rapport</a>
                        <a href="" class="collection-item black-text">Liste des rapports</a>
                      </div>
                  </div>
                </li>
              </ul>
            </div>

            <!-- Lien modification ou suppression des informations -->
            <div class="card-action white">
              <a class="blue-text text-lighten-1" href="<?= "index.php?action=childAdmin&id=" . $children['id'] ?>">Modifier</a>

              <!-- Suppression d'un enfant avec popup confirmation coté ADMIN -->
              <?php if ($_SESSION['admin'] == 1): ?>
                <a class="blue-text text-lighten-1 right-align modal-trigger" href="#modal<?= $children['id']?>">Supprimer</a>

                <div id="modal<?=$children['id']?>" class="modal">
                  <div class="modal-content">
                    <h4>Suppression</h4>
                    <p>Voulez-vous supprimer la fiche de <?= $children['childName'] . " " . $children['familyName']?></p>

                    <!-- FORMULAIRE SUPPRESSION D'UN ENFANT -->
                    <form class="" action="index.php?action=deleteChild&id=<?= $children['id']?>" method="post">
                      <!-- Données envoyées caché pour vérification -->
                      <input type="hidden" name="idChild" value="<?= $children['id'] ?>">
                      <!-- Bouton valider et annuler -->
                      <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Supprimer</button>
                      <a href="#!" class="modal-close btn waves-effect waves-light deep-orange lighten-2">Annuler</a>
                    </form>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>



      <!-- AJOUT D'UN ENFANT PARTIE ADMINISTRATEUR -->


      <?php if ($_SESSION['admin'] == 1): ?>
        <!-- Bouton création d'un enfant -->
        <div class="col s12 m6 center">
          <br>
          <a class="btn-floating btn-large waves-effect waves-light blue lighten-1 btn modal-trigger" href="#popup"><i class="material-icons">person_add</i></a>
        </div>

        <!-- Popup formulaire de création -->
        <div id="popup" class="modal">
          <div class="modal-content">
            <h4 class="deep-orange-text text-lighten-2">Création d'une fiche enfant:</h4>
            <!-- FORMULAIRE DE CREATION DE L'ENFANT -->
            <form class="col s12" action="index.php?action=createChild" method="post">

              <div class="row">
                <!-- Prenom -->
                <div class="input-field col s12 m6">
                  <input id="childName" name="childName" type="text" class="validate" required />
                  <label for="childName">Prénom</label>
                </div>
                <!-- Nom -->
                <div class="input-field col s12 m6">
                  <input id="familyName" name="familyName" type="text" class="validate" required />
                  <label for="familyName">Nom</label>
                </div>
              </div>

              <div class="row">
                <!-- Parents -->
                <div class="input-field col s6 m6">
                  <select name="parentId" required>
                    <option value="" disabled selected>Sélectionnez un parent</option>
                    <?php foreach ($user as $user): ?>
                      <?php if ($user['admin'] == 0): ?>
                        <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>

                <!-- Date de naissance -->
                <div class="input-field col s6 m6">
                  <input id="birthday" name="birthday" type="text" class="datepicker" required>
                  <label for="birthday">Date de naissance</label>
                </div>
              </div>

              <div class="row">
                <!-- Taille -->
                <div class="range-field col s6">
                  <label for="height">Taille (cm)</label>
                  <input id="height" name="height" type="range" min="30" max="150" required />
                </div>
                <!-- Poids -->
                <div class="range-field col s6">
                  <label for="weight">Poids (kg)</label>
                  <input id="weight" name="weight" type="range" min="0" max="25" step="0.01" required />
                </div>
              </div>

              <div class="row">
                <!-- Informations -->
                <div class="input-field col s12">
                  <textarea id="note" name="note" class="materialize-textarea"></textarea>
                  <label for="note">Informations</label>
                </div>
              </div>

              <!-- Bouton Valider -->
              <div class="row center">
                <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Valider</button>
                <button class="btn waves-effect waves-light modal-close deep-orange lighten-2" type="submit" name="action">Annuler</button>
              </div>
            </form>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
