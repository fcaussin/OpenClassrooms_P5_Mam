<!-- TITRE DE LA PAGE -->
<?php $this->title = "Liste des comptes-rendus de " . $child['childName']; ?>

<!-- MAIN -->

  <div class="container">
    <div class="row">
      <div class="col s12 center">
        <h4>Liste des comptes-rendus par mois de : <span class="deep-orange-text text-lighten-2"><?= $child['childName'] . " " . $child['familyName'] ?></span></h4>
        <p>Choisissez un mois pour accéder aux comptes-rendus du mois.</p>
        <br />
      </div>

      <div class="collection col s12 m6 offset-m3">

        <?php foreach ($report as $report): ?>
          <a href="index.php?action=listReports&id=<?= $child['id'] ?>&parentId=<?= $child['parentId'] ?>&monthId=<?= $report['monthNumber']?>" class="collection-item"><span class="badge"><?= $report['monthCount']?></span><?= $report['monthDate']?></a>
        <?php endforeach; ?>
          <a href="index.php?action=login" class="collection-item blue-text text-lighten-1">Retour</a>
      </div>
    </div>
  </div>
