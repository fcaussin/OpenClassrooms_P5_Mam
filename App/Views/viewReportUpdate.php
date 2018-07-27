<!-- TITRE DE LA PAGE -->
<?php $this->title = "Modifier le compte-rendu de " . $child['childName']; ?>

<!-- MAIN -->
<div class="container">
  <div class="section">
    <div class="row">
      <h4 class="center">Modifier le compte-rendu de : <span class="deep-orange-text text-lighten-2"><?= $child['childName'] . " " . $child['familyName'] ?></span></h4>


      <!-- FORMULAIRE DE MODIFICATION D'UN RAPPORT -->

      <form class="col s12" action="index.php?action=updateReport" method="post">

        <div class="row">
          <!-- Date d'accueil -->
          <div class="input-field col s6 m6">
            <input id="dateReport" name="dateReport" type="text" class="datepicker" value="<?= $report['dateReport_fr'] ?>" required>
            <label for="dateReport">Date d'accueil</label>
          </div>
        </div>

        <div class="row">
          <!-- Comportement -->
          <div class="input-field col s12 m6">
            <select id="behavior" name="behavior" value="<?= $report['behavior'] ?>">
              <option value="Parfait">Parfait</option>
              <option value="Bon">Bon</option>
              <option value="Mauvais">Mauvais</option>
            </select>
            <label for="behavior">Evaluation de la journée</label>
          </div>
          <!-- Commentaires -->
          <div class="input-field col s12 m6">
            <textarea id="comments" name="comments" class="materialize-textarea"><?= $report['comments'] ?></textarea>
            <label for="comments">Commentaires</label>
          </div>
        </div>

        <div class="row">
          <!-- Activities -->
          <div class="input-field col s12 m6">
            <textarea id="activities" name="activities" class="materialize-textarea"><?= $report['activities'] ?></textarea>
            <label for="activities">Activités</label>
          </div>
          <!-- Repas -->
          <div class="input-field col s12 m6">
            <textarea id="meal" name="meal" class="materialize-textarea"><?= $report['meal'] ?></textarea>
            <label for="meal">Repas</label>
          </div>
        </div>

        <div class="row">
          <!-- Sieste -->
          <div class="input-field col s12 m6">
            <textarea id="nap" name="nap" class="materialize-textarea"><?= $report['nap'] ?></textarea>
            <label for="nap">Sieste</label>
          </div>
          <!-- Informations -->
          <div class="input-field col s12 m6">
            <textarea id="info" name="info" class="materialize-textarea"><?= $report['info'] ?></textarea>
            <label for="info">Information(s) et Rappel(s)</label>
          </div>
        </div>

        <!-- Bouton Valider et Annuler -->
        <div class="row center">
          <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Valider</button>
          <button class="btn waves-effect waves-light deep-orange lighten-2"
          type="submit" formaction="index.php?action=login">Annuler</button>
        </div>

        <!-- Données supplémentaires envoyées -->
        <input type="hidden" name="childId" value="<?= $report['childId'] ?>" />
        <input type="hidden" name="reportId" value="<?= $report['id'] ?>" />
      </form>
    </div>
  </div>
</div>
