<?php
  namespace App\Models;

  class Children
  {
    private $id,
            $parentId,
            $childName,
            $birthday,
            $note;

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

    public function parentId()
    {
      return $this->parentId;
    }

    public function childName()
    {
      return $this->childName;
    }

    public function familyName()
    {
      return $this->familyName;
    }

    public function birthday()
    {
      return $this->birthday;
    }

    public function height()
    {
      return $this->height;
    }

    public function weight()
    {
      return $this->weight;
    }

    public function note()
    {
      return $this->note;
    }

    // SETTERS

    public function setId($id)
    {
      $this->id = (int) $id;
    }

    public function setParentId($parentId)
    {
      $this->parentId = (int) $parentId;
    }

    public function setChildName($childName)
    {
      if (is_string($childName)) {
        $this->childName = $childName;
      }
    }

    public function setFamilyName($familyName)
    {
      if (is_string($familyName)) {
        $this->familyName = $familyName;
      }
    }

    public function setBirthday($birthday)
    {
      $this->birthday = $birthday;
    }

    public function setHeight($height)
    {
      $this->height = (int) $height;
    }

    public function setWeight($weight)
    {
      $this->weight = (float) $weight;
    }

    public function setNote($note)
    {
      if (is_string($note)) {
        $this->note = $note;
      }
    }
  }
?>
