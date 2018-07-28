<?php
  namespace App\Models;

  use App\Config\PDOManager;


  class ReportManager extends PDOManager
  {
    
    // RECUPERER LE DERNIER RAPPORT D'UN ENFANT
    public function lastReport($childId)
    {
      $sql = "SELECT id, childId, DATE_FORMAT(dateReport, '%d-%m-%Y') AS dateReport_fr, behavior, comments, activities, meal, nap, info FROM report WHERE childId = ? ORDER BY dateReport DESC LIMIT 0, 1";

      $req = $this->executeRequest($sql, array($childId));
      $report = $req->fetch();

      return $report;
      $req->closeCursor();
    }


    // RECUPERER UN RAPPORT D'UN ENFANT
    public function getReportById($reportId, $childId)
    {
      $sql = "SELECT id, childId, DATE_FORMAT(dateReport, '%d-%m-%Y') AS dateReport_fr, behavior, comments, activities, meal, nap, info FROM report WHERE id = ? AND childId = ?";

      $req = $this->executeRequest($sql, array($reportId, $childId));
      $report = $req->fetch();

      return $report;
      $req->closeCursor();
    }


    //RECUPERER LES RAPPORTS DU MOIS ET DE MOINS D'UN AN D'UN ENFANT
    public function getReports($childId, $monthId)
    {
      $sql = "SELECT id, childId, DATE_FORMAT(dateReport, '%d-%m-%Y') AS dateReport_fr, behavior FROM report WHERE childId = ? AND MONTH(dateReport) = ? AND DATEDIFF(NOW(), dateReport) <= 365 ORDER BY dateReport DESC";

      $reports = $this->executeRequest($sql, array($childId, $monthId));

      return $reports;
    }


    // RECUPERER LES RAPPORTS DE MOINS D'UN AN D'UN ENFANT PAR MOIS
    public function getReportsByMonth($childId)
    {
      $sql = "SELECT childId, COUNT(MONTH(dateReport)) AS monthCount, CASE MONTH(dateReport)
                 WHEN 1 THEN 'Janvier'
                 WHEN 2 THEN 'Février'
                 WHEN 3 THEN 'Mars'
                 WHEN 4 THEN 'Avril'
                 WHEN 5 THEN 'Mai'
                 WHEN 6 THEN 'Juin'
                 WHEN 7 THEN 'Juillet'
                 WHEN 8 THEN 'Août'
                 WHEN 9 THEN 'Septembre'
                 WHEN 10 THEN 'Octobre'
                 WHEN 11 THEN 'Novembre'
                 ELSE 'Décembre'
        END AS monthDate, MONTH(dateReport) AS monthNumber FROM report WHERE childId = ? AND DATEDIFF(NOW(), dateReport) <= 365 GROUP BY monthDate ORDER BY dateReport DESC";

      $reports = $this->executeRequest($sql, array($childId));

      return $reports;
    }


    // AJOUTER UN RAPPORT
    public function addReport(Report $report)
    {
      $sql = "INSERT INTO report(childId, dateReport, behavior, comments, activities, meal, nap, info) VALUES(?,?,?,?,?,?,?,?)";
      $newReport = $this->executeRequest($sql, array($report->childId(), $report->dateReport(), $report->behavior(), $report->comments(), $report->activities(), $report->meal(), $report->nap(), $report->info()));

      return $newReport;
    }


    // MODIFIER UN RAPPORT
    public function updateReport(Report $report)
    {
      $sql = "UPDATE report SET childId = ?, dateReport = ?, behavior = ?, comments = ?, activities = ?, meal = ?, nap = ?, info = ? WHERE id = ?";
      $updateReport = $this->executeRequest($sql, array($report->childId(), $report->dateReport(), $report->behavior(), $report->comments(), $report->activities(), $report->meal(), $report->nap(), $report->info(), $report->id()));

      return $updateReport;
    }


    // EFFACER UN RAPPORT
    public function deleteReport($id)
    {
      $sql = "DELETE FROM report WHERE id = ?";
      $this->executeRequest($sql, array($id));
    }
  }
?>
