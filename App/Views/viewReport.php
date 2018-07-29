<!-- TITRE DE LA PAGE -->
<?php $this->title = "Compte-rendu de " . $child['childName']; ?>

<!-- MAIN -->

<div class="container report-page">
  <div class="row">

    <!-- Titre -->
    <div class="col s12 center">
      <h4>Compte-rendu de : <span class="deep-orange-text text-lighten-2"><?= $child['childName'] . " " . $child['familyName'] ?></span></h4>
      <br />
      <h6>Date d'accueil : <?= $report['dateReport_fr'] ?></h6>
      <br /><br />
    </div>

    <div class="col s12 report-content">

      <!-- Comportement -->
      <div class="col s12 center">
        <div class="report-title">
          <h5>Comment s'est déroulée ma journée ?</h5>
          <span><i class="medium material-icons deep-orange-text text-lighten-2">

            <!-- Affiche un emoticon en fonction du comportement -->
            <?php switch ($report['behavior']) {
              case 'Parfait':
                echo "sentiment_very_satisfied";
              break;

              case 'Bon':
                echo "sentiment_neutral";
              break;

              default:
                echo "sentiment_very_dissatisfied";
              break;
            } ?>
          </i></span>
        </div>
      </div>

      <!-- Commentaires -->
      <div class="col s12 m6">
        <div class="report-info">
          <h5 class="center">Commentaires</h5>
          <p><?= $report['comments'] ?></p>
        </div>
      </div>

      <!-- Activités -->
      <div class="col s12 m6">
        <div class="report-info">
          <h5 class="center">Activité(s)</h5>
          <p><?=$report['activities']?></p>
        </div>
      </div>

      <!-- Repas -->
      <div class="col s12 m3">
        <div class="report-info2">
          <h5 class="center">Repas</h5>
          <p><?=$report['meal']?></p>
        </div>
      </div>

      <!-- Sieste -->
      <div class="col s12 m3">
        <div class="report-info2 center">
          <h5 class="center">Sieste</h5>
          <p><?=$report['nap']?></p>
        </div>
      </div>

      <!-- Informations -->
      <div class="col s12 m6">
        <div class="report-info3">
          <h5 class="center">Information(s) et Rappel(s)</h5>

          <!-- SI base de données vide affiche "Aucune informations" -->
          <?php if (!$report['info']): ?>
            <p>Aucune information</p>
            <!-- SINON affiche l'information -->
          <?php else: ?>
            <p><?= $report['info'] ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="row">

      <!-- SI l'utilisateur est un administrateur -->
      <?php if ($_SESSION['admin'] == 1): ?>

        <!-- LIEN: Modifier le rapport -->
        <div class="col s12 m6 center">
          <p><a href="index.php?action=reportAdmin&id=<?= $report['id'] ?>&childId=<?= $child['id'] ?>" class="blue-text text-lighten-1">Modifier le rapport</a></p>
        </div>

        <!-- LIEN POPUP: Supprimer le rapport -->
        <div class="col s12 m6 center">
          <p><a class="blue-text text-lighten-1 right-align modal-trigger" href="#modal">Supprimer le rapport</a></p>


          <!-- POPUP: SUPPRESSION D'UN RAPPORT -->

          <div id="modal" class="modal">
            <div class="modal-content">
              <h4>Suppression</h4>
              <p>Voulez-vous supprimer le rapport de <?= $child['childName'] . " " . $child['familyName']?></p>


              <!-- FORMULAIRE SUPPRESSION D'UN ENFANT -->

              <form action="index.php?action=deleteReport&id=<?= $report['id']?>" method="post">
                <!-- Données envoyées caché pour vérification -->
                <input type="hidden" name="reportId" value="<?= $report['id'] ?>">
                <!-- Bouton valider et annuler -->
                <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Supprimer</button>
                <a href="#!" class="modal-close btn waves-effect waves-light deep-orange lighten-2">Annuler</a>
              </form>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- LIEN: Retour à la liste des rapports -->
      <div class="col s12 center">
        <p><a href="index.php?action=listReportByMonth&id=<?= $child['id'] ?>&parentId=<?= $child['parentId'] ?>" class="blue-text text-lighten-1">Retour à la liste des rapports</a></p>
      </div>
    </div>
  </div>
  <br />
</div>
