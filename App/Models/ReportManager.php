<?php
  namespace App\Models;

  use App\Config\PDOManager;


  class ReportManager extends PDOManager
  {

    // Récupère le dernier rapport d'un enfant
    public function lastReport($childId)
    {
      $sq = "SELECT id, childId, DATE_FORMAT(dateReport, '%d-%m-%Y') AS dateReport_fr, behavior, comments, activities, meal, nap FROM report WHERE childId = ? ORDER BY dateReport DESC LIMIT 0, 1";

      $report = $this->executeRequest($sql, array($childId));

      return $report;
    }

    // Récupère les rapport d'un enfants
    public function getReports($childId)
    {
      $sql = "SELECT id, childId, DATE_FORMAT(dateReport, '%d-%m-%Y') AS dateReport_fr, behavior, comments, activities, meal, nap FROM report WHERE childId = ? ORDER BY dateReport DESC";

      $reports = $this->executeRequest($sql, array($childId));

      return $reports;
    }

    // Ajouter un rapport
    public function addReport(Report $report)
    {
      $sql = "INSERT INTO report(childId, dateReport, behavior, comments, activities, meal, nap) VALUES(?,NOW(),?,?,?,?,?)";
      $newReport = $this->executeRequest($sql, array($report->childId(), $report->behavior(), $report->comments(), $report->activities(), $report->meal(), $report->nap()));

      return $newReport;
    }

    // Modifier un rapport
    public function updateReport(Report $report)
    {
      $sql = "UPDATE report SET childId = ?, behavior = ?, comments = ?, activities = ?, meal = ?, nap = ? WHERE id = ?";
      $updateReport = $this->executeRequest($sql, array($report->childId(), $report->behavior(), $report->comments(), $report->activities(), $report->meal(), $report->nap()));

      return $updateReport;
    }

    // Effacer un rapport
    public function deleteReport($id)
    {
      $sql = "DELETE FROM report WHERE id = ?";
      $this->executeRequest($sq, array($id));
    }

  }

?>
