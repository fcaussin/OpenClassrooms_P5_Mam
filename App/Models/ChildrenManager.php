<?php
  namespace App\Models;

  use App\Config\PDOManager;

  class ChildrenManager extends PDOManager
  {
    // Récupère les enfants d'un utilisateur
    public function getChildren($parentId)
    {
      $sql = "SELECT id, parentId, childName, familyName, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday_fr, height, weight, note FROM children WHERE parentId = ? ORDER BY childName";

      $children = $this->executeRequest($sql, array($parentId));

      return $children;
    }

    // Récupère un enfant avec son id
    public function getChild($childId)
    {
      $sql = "SELECT id, parentId, childName, familyName, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday_fr, height, weight, note FROM children WHERE id = ?";

      $req = $this->executeRequest($sql, array($childId));
      $children = $req->fetch();

      return $children;
      $req->closeCursor();
    }

    // Récupère tous les enfants
    public function getAllChildren()
    {
      $sql = "SELECT id, parentId, childName, familyName, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday_fr, height, weight, note FROM children ORDER BY familyName, childName";

      $children = $this->executeRequest($sql);

      return $children;
    }

    // Ajouter un enfant
    public function addChild(Children $children)
    {
      $sql = "INSERT INTO children(parentId, childName, familyName, birthday, height, weight, note) VALUES(?,?,?,?,?,?,?)";
      $newChild = $this->executeRequest($sql, array($children->parentId(), $children->childName(), $children->familyName(), $children->birthday(), $children->height(), $children->weight(), $children->note()));

      return $newChild;
    }

    // Modifier un enfant
    public function updateChild(Children $children)
    {
      $sql = "UPDATE children SET parentId = ?, childName = ?, familyName = ?, birthday = ?, height = ?, weight = ?, note = ? WHERE id = ?";
      $updateChild = $this->executeRequest($sql, array($children->parentId(), $children->childName(), $children->familyName(), $children->birthday(), $children->height(), $children->weight(), $children->note(), $children->id()));

      return $updateChild;
    }

    // Effacer un enfant
    public function deleteChild($id)
    {
      $sql = "DELETE FROM children WHERE id = ?";
      $this->executeRequest($sql, array($id));
    }
  }
?>
