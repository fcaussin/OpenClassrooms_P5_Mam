<!-- TITRE DE LA PAGE -->
<?php $this->title = "Modification des infos de " . $child['childName']; ?>

<!-- MAIN -->
<div class="container">
  <div class="section">
    <div class="row">
      <!-- Titre -->
      <h4 class="center">Modifier les informations de : <span class="deep-orange-text text-lighten-2"><?= $child['childName'] . " " . $child['familyName'] ?></span></h4>


      <!-- FORMULAIRE DE MODIFICATION DE L'ENFANT -->

      <form class="col s12" action="index.php?action=updateChild" method="post">

        <div class="row">
          <!-- Prenom -->
          <div class="input-field col s12 m6">
            <input id="childName" name="childName" type="text" class="validate" value="<?= $child['childName'] ?>" required />
            <label for="childName">Prénom</label>
          </div>
          <!-- Nom -->
          <div class="input-field col s12 m6">
            <input id="familyName" name="familyName" type="text" class="validate" value="<?= $child['familyName'] ?>" required />
            <label for="familyName">Nom</label>
          </div>
        </div>

        <div class="row">
          <!-- Date de naissance -->
          <div class="input-field col s6 m6">
            <input value="<?= $child['birthday_fr'] ?>" id="birthday" name="birthday" type="text" class="datepicker" required>
            <label for="birthday">Date de naissance</label>
          </div>
        </div>

        <div class="row">
          <!-- Taille -->
          <div class="range-field col s6">
            <label for="height">Taille (cm)</label>
            <output id="range_height_disp"><?= $child['height'] ?></output>
            <input id="range_height" name="height" type="range" min="30" max="150" value="<?= $child['height'] ?>" oninput="range_height_disp.value = range_height.value" required />
          </div>
          <!-- Poids -->
          <div class="range-field col s6">
            <label for="weight">Poids (kg)</label>
            <output id="range_weight_disp"><?= $child['weight'] ?></output>
            <input id="range_weight" name="weight" type="range" min="0" max="25" step="0.01" value="<?= $child['weight'] ?>" oninput="range_weight_disp.value = range_weight.value" required />
          </div>
        </div>

        <div class="row">
          <!-- Informations -->
          <div class="input-field col s12">
            <textarea id="note" name="note" class="materialize-textarea"><?= $child['note'] ?></textarea>
            <label for="note">Informations</label>
          </div>
        </div>

        <!-- Bouton Valider et Annuler -->
        <div class="row center">
          <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Valider</button>
          <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" formaction="index.php?action=login">Annuler</button>
        </div>

        <!-- Donnees supplémentaires envoyées -->
        <input type="hidden" name="childId" value="<?= $child['id'] ?>" />
        <input type="hidden" name="parentId" value="<?= $child['parentId'] ?>" />
      </form>
    </div>
  </div>
</div>
