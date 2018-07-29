<!-- TITRE DE LA PAGE -->
<?php $this->title = "Créer un nouveau compte-rendu pour " . $child['childName']; ?>

<!-- MAIN -->
<div class="container">
  <div class="section">
    <div class="row">
      <h4 class="center">Ajouter un compte-rendu à : <span class="deep-orange-text text-lighten-2"><?= $child['childName'] . " " . $child['familyName'] ?></span></h4>


      <!-- FORMULAIRE DE CREATION D'UN RAPPORT -->

      <form class="col s12" action="index.php?action=createReport" method="post">

        <div class="row">
          <!-- Date d'accueil -->
          <div class="input-field col s6 m6">
            <input id="dateReport" name="dateReport" type="text" class="datepicker" required>
            <label for="dateReport">Date d'accueil</label>
          </div>
        </div>

        <div class="row">
          <!-- Comportement -->
          <div class="input-field col s12 m6">
            <select id="behavior" name="behavior">
              <option value="Parfait">Parfait</option>
              <option value="Bon" selected>Bon</option>
              <option value="Mauvais">Mauvais</option>
            </select>
            <label for="behavior">Comportement de la journée</label>
          </div>
          <!-- Commentaires -->
          <div class="input-field col s12 m6">
            <textarea id="comments" name="comments" class="materialize-textarea"></textarea>
            <label for="comments">Commentaires</label>
          </div>
        </div>

        <div class="row">
          <!-- Activities -->
          <div class="input-field col s12 m6">
            <textarea id="activities" name="activities" class="materialize-textarea"></textarea>
            <label for="activities">Activités</label>
          </div>
          <!-- Repas -->
          <div class="input-field col s12 m6">
            <textarea id="meal" name="meal" class="materialize-textarea"></textarea>
            <label for="meal">Repas</label>
          </div>
        </div>

        <div class="row">
          <!-- Sieste -->
          <div class="input-field col s12 m6">
            <textarea id="nap" name="nap" class="materialize-textarea"></textarea>
            <label for="nap">Sieste</label>
          </div>
          <!-- Informations -->
          <div class="input-field col s12 m6">
            <textarea id="info" name="info" class="materialize-textarea"></textarea>
            <label for="info">Information(s) et Rappel(s)</label>
          </div>
        </div>

        <!-- Bouton Valider et Annuler -->
        <div class="row center">
          <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Valider</button>
          <button class="btn waves-effect waves-light deep-orange lighten-2"
          type="reset">Effacer</button>
        </div>

        <!-- Données supplémentaires envoyées -->
        <input type="hidden" name="childId" value="<?= $child['id'] ?>" />
      </form>

      <!-- LIEN: Retour à la page d'accueil -->
      <div class="row center">
        <p><a href="index.php?action=login" class="collection-item blue-text text-lighten-1">Retour</a></p>
      </div>
    </div>
  </div>
</div>
