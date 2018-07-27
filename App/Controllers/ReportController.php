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

    public function lastChildReport($childId)
    {
      // Récupère le dernier rapport d'un enfant
      $report = $this->reports->lastReport($childId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);


      if (($_SESSION['admin'] == 1 && isset($child["id"])) || $child['parentId'] == $_SESSION['id'])
      {
        if (isset($report['id'])) {
          // Affiche la vue Report
          $viewLastReport = new View("Report");
          $viewLastReport->generateView(array('report' => $report, 'child' => $child));
        }
        else {
          throw new \Exception("Aucun compte rendu");
        }
      }
      else {
        // Affiche l'erreur
        throw new \Exception("Cet enfant ou ce compte-rendu n'existe pas");
      }
    }

    public function childReport($childId, $reportId)
    {
      // Récupère le rapport d'un enfant
      $report = $this->reports->getReportById($reportId, $childId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      if (!$report['id'] || ($child['id'] != $report['childId']))
      {
        throw new \Exception("Cet enfant ou ce compte-rendu n'existe pas");
      }
      else {
        // Affiche la vue Report
        $viewReport = new View("Report");
        $viewReport->generateView(array('report' => $report, 'child' => $child));
      }
    }

    public function listReportsByMonth($childId)
    {
      // Récupère la liste des reports par mois d'un enfant
      $report = $this->reports->getReportsByMonth($childId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      if (($_SESSION['admin'] == 1 && isset($child["id"])) || $child['parentId'] == $_SESSION['id']) {
        $viewListReportByMonth = new View("ListReportsByMonth");
        $viewListReportByMonth->generateView(array('report' => $report, 'child' => $child));
      }
      else
      {
        throw new \Exception("Cet enfant n'existe pas");
      }
    }

    public function listReports($childId, $monthId)
    {
      // Récupère la liste des report du mois d'un enfant
      $report = $this->reports->getReports($childId, $monthId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      if (($_SESSION['admin'] == 1 && isset($child["id"])) || $child['parentId'] == $_SESSION['id'])
      {
        $viewListReport = new View("ListReports");
        $viewListReport->generateView(array('report' => $report, 'child' => $child));
      }
      else {
        throw new \Exception("Cet enfant ou ce rapport n'existe pas");
      }
    }

    public function newReport($childId)
    {
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      if (isset($child['id'])) {
        $viewNewReport = new View("NewReport");
        $viewNewReport->generateView(array('child' => $child));
      }
      else {
        throw new \Exception("Cet enfant n'existe pas");
      }
    }

    public function createReport($childId, $dateReport, $behavior, $comments, $activities, $meal, $nap, $info)
    {
      $newReport = new Report (['childId' => $childId, 'dateReport' => $dateReport, 'behavior' => $behavior, 'comments' => $comments, 'activities' => $activities, 'meal' => $meal, 'nap' => $nap, 'info' => $info]);
      $this->reports->addReport($newReport);

      $this->lastChildReport($childId);
    }

    public function changeReport($childId, $dateReport, $behavior, $comments, $activities, $meal, $nap, $info, $id)
    {
      $reportUpdate = new Report (['childId' => $childId, 'dateReport' => $dateReport, 'behavior' => $behavior, 'comments' => $comments, 'activities' => $activities, 'meal' => $meal, 'nap' => $nap, 'info' => $info, 'id' => $id]);
      $this->reports->updateReport($reportUpdate);

      $this->childReport($childId, $id);
    }

    public function eraseReport($reportId)
    {
      $this->reports->deleteReport($reportId);
    }

    public function reportAdmin($reportId, $childId)
    {
      // Récupère les infos du rapport
      $report = $this->reports->getReportById($reportId, $childId);
      // Récupère les infos de l'enfant
      $child = $this->children->getChild($childId);

      if (!$report['id'] || ($child['id'] != $report['childId']))
      {
        throw new \Exception("Cet enfant ou ce compte-rendu n'existe pas");
      }
      else {
        // Affiche la vue Report
        $viewReport = new View("ReportUpdate");
        $viewReport->generateView(array('report' => $report, 'child' => $child));
      }
    }
  }
?>
