<!-- TITRE DE LA PAGE -->
<?php $this->title = "Liste des comptes-rendus de " . $child['childName']; ?>

<!-- MAIN -->
<div class="container">
  <div class="row">
    <div class="col s12 center">
      <h4>Liste des comptes-rendus de : <span class="deep-orange-text text-lighten-2"><?= $child['childName'] . " " . $child['familyName'] ?></span></h4>
      <p>Sélectionnez un compte-rendu</p>
      <br />
    </div>

    <div class="collection col s12 m6 offset-m3">

      <!-- Affiche tous les rapport du mois sélectionné -->
      <?php foreach ($report as $report): ?>
        <a href="index.php?action=reportById&id=<?= $child['id'] ?>&parentId=<?= $child['parentId'] ?>&reportId=<?= $report['id'] ?>" class="collection-item"><span class="badge"><i class="material-icons deep-orange-text text-lighten-2">

          <!-- Affiche un emoticon du comportement de chaque rapport -->
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

        </i></span><?= $report['dateReport_fr']?></a>
      <?php endforeach; ?>

      <!-- LIEN: Retour à la sélection des rapports par mois -->
      <a href="index.php?action=listReportByMonth&id=<?= $child['id'] ?>&parentId=<?= $child['parentId'] ?>" class="collection-item blue-text text-lighten-1">Retour</a>
    </div>
  </div>
</div>
