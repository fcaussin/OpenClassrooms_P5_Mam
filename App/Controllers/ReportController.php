<?php
  namespace App\Controllers;

  use App\Models\ReportManager;
  use App\Models\Report;
  use App\Models\ChildrenManager;
  use App\Views\View;

  class ReportController
  {
    private $reports;
    private $children;

    public function __construct()
    {
      $this->reports = new ReportManager;
      $this->children = new ChildrenManager;
    }


    // AFFICHER LE DERNIER RAPPORT D'UN ENFANT
    public function lastChildReport($childId)
    {
      // Récupère le dernier rapport d'un enfant
      $report = $this->reports->lastReport($childId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      // SI Administrateur et enfant existe OU l'enfant appartient à l'utilisateur
      if (($_SESSION['admin'] == 1 && isset($child["id"])) || $child['parentId'] == $_SESSION['id'])
      {
        // SI le rapport existe
        if (isset($report['id'])) {
          // Affiche la vue Report
          $viewLastReport = new View("Report");
          $viewLastReport->generateView(array('report' => $report, 'child' => $child));
        }
        // SINON Affiche un message d'erreur
        else {
          throw new \Exception("Aucun compte rendu");
        }
      }
      else {
        throw new \Exception("Cet enfant ou ce compte-rendu n'existe pas");
      }
    }


    // AFFICHER LE RAPPORT D'UN ENFANT
    public function childReport($childId, $reportId)
    {
      // Récupère le rapport d'un enfant
      $report = $this->reports->getReportById($reportId, $childId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      // SI le rapport n'existe pas OU le rapport n'appartient pas à l'enfant
      if (!$report['id'] || ($child['id'] != $report['childId']))
      {
        // Envoie un message d'erreur
        throw new \Exception("Cet enfant ou ce compte-rendu n'existe pas");
      }
      // SINON Affiche la vue Report
      else {
        $viewReport = new View("Report");
        $viewReport->generateView(array('report' => $report, 'child' => $child));
      }
    }


    // RECUPERER LA LISTE DES RAPPORTS PAR MOIS D'UN ENFANT
    public function listReportsByMonth($childId)
    {
      // Récupère la liste des reports par mois d'un enfant
      $report = $this->reports->getReportsByMonth($childId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      //SI Administrateur et enfant existe OU l'enfant appartient à l'utilisateur
      if (($_SESSION['admin'] == 1 && isset($child["id"])) || $child['parentId'] == $_SESSION['id']) {
        // Affiche la vue ListReportsByMonth
        $viewListReportByMonth = new View("ListReportsByMonth");
        $viewListReportByMonth->generateView(array('report' => $report, 'child' => $child));
      }
      // Sinon Envoie un message d'erreur
      else
      {
        throw new \Exception("Cet enfant n'existe pas");
      }
    }


    // RECUPERER LA LISTE DES RAPPORT D'UN ENFANT
    public function listReports($childId, $monthId)
    {
      // Récupère la liste des report du mois d'un enfant
      $report = $this->reports->getReports($childId, $monthId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      // SI Administrateur et enfant existe OU Enfant appartient à l'utilisateur
      if (($_SESSION['admin'] == 1 && isset($child["id"])) || $child['parentId'] == $_SESSION['id'])
      {
        // Affiche la vue ListReports
        $viewListReport = new View("ListReports");
        $viewListReport->generateView(array('report' => $report, 'child' => $child));
      }
      // SINON Envoie un message d'erreur
      else {
        throw new \Exception("Cet enfant ou ce rapport n'existe pas");
      }
    }


    // AFFICHER LA CREATION D'UN NOUVEAU RAPPORT
    public function newReport($childId)
    {
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      // SI l'enfant existe
      if (isset($child['id'])) {
        $viewNewReport = new View("NewReport");
        $viewNewReport->generateView(array('child' => $child));
      }
      // SINON Envoie un message d'erreur
      else {
        throw new \Exception("Cet enfant n'existe pas");
      }
    }


    // CREER UN RAPPORT
    public function createReport($childId, $dateReport, $behavior, $comments, $activities, $meal, $nap, $info)
    {
      // Récupère les données
      $newReport = new Report (['childId' => $childId, 'dateReport' => $dateReport, 'behavior' => $behavior, 'comments' => $comments, 'activities' => $activities, 'meal' => $meal, 'nap' => $nap, 'info' => $info]);

      // Créé le rapport
      $this->reports->addReport($newReport);

      // Affiche le dernier rapport de l'enfant
      $this->lastChildReport($childId);
    }


    // MODIFIER UN RAPPORT
    public function changeReport($childId, $dateReport, $behavior, $comments, $activities, $meal, $nap, $info, $id)
    {
      // Récupère les données
      $reportUpdate = new Report (['childId' => $childId, 'dateReport' => $dateReport, 'behavior' => $behavior, 'comments' => $comments, 'activities' => $activities, 'meal' => $meal, 'nap' => $nap, 'info' => $info, 'id' => $id]);

      // Modifie le rapport
      $this->reports->updateReport($reportUpdate);

      // Affiche le rapport modifié
      $this->childReport($childId, $id);
    }


    // EFFACER UN RAPPORT
    public function eraseReport($reportId)
    {
      $this->reports->deleteReport($reportId);
    }


    // AFFICHER LA MODIFICATION D'UN RAPPORT
    public function reportAdmin($reportId, $childId)
    {
      // Récupère les infos du rapport
      $report = $this->reports->getReportById($reportId, $childId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      // SI rapport n'existe pas OU le rapport n'appartient pas à l'enfant
      if (!$report['id'] || ($child['id'] != $report['childId']))
      {
        // Envoie un message d'erreur
        throw new \Exception("Cet enfant ou ce compte-rendu n'existe pas");
      }
      // SINON Affiche la vue ReportUpdate
      else {
        // Affiche la vue ReportUpdate
        $viewReport = new View("ReportUpdate");
        $viewReport->generateView(array('report' => $report, 'child' => $child));
      }
    }
  }
?>
