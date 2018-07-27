<?php
  namespace App\Models;


  class Report
  {
    private $id,
            $childId,
            $dateReport,
            $behavior,
            $comments,
            $activities,
            $meal,
            $nap,
            $info;

    public function hydrate($data)
    {
      foreach ($data as $key => $value) {
        $method = "set".ucfirst($key);

        if (method_exists($this, $method)) {
          $this->$method($value);
        }
      }
    }

    public function __construct(array $data =[])
    {
      if (!empty($data)) {
        $this->hydrate($data);
      }
    }

    // GETTERS

    public function id()
    {
      return $this->id;
    }

    public function childId()
    {
      return $this->childId;
    }

    public function dateReport()
    {
      return $this->dateReport;
    }

    public function behavior()
    {
      return $this->behavior;
    }

    public function comments()
    {
      return $this->comments;
    }

    public function activities()
    {
      return $this->activities;
    }

    public function meal()
    {
      return $this->meal;
    }

    public function nap()
    {
      return $this->nap;
    }

    public function info()
    {
      return $this->info;
    }

    // SETTERS

    public function setId($id)
    {
      $this->id = (int) $id;
    }

    public function setChildId($childId)
    {
      $this->childId = (int) $childId;
    }

    public function setDateReport($dateReport)
    {
      $this->dateReport = $dateReport;
    }

    public function setBehavior($behavior)
    {
      if (is_string($behavior)) {
        $this->behavior = $behavior;
      }
    }

    public function setComments($comments)
    {
      if (is_string($comments)) {
        $this->comments = $comments;
      }
    }

    public function setActivities($activities)
    {
      if (is_string($activities)) {
        $this->activities = $activities;
      }
    }

    public function setMeal($meal)
    {
      if (is_string($meal)) {
        $this->meal = $meal;
      }
    }

    public function setNap($nap)
    {
      if (is_string($nap)) {
        $this->nap = $nap;
      }
    }

    public function setInfo($info)
    {
      if (is_string($info)) {
        $this->info = $info;
      }
    }
  }
?>
