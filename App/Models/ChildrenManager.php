<?php
  namespace App\Models;

  use App\Config\PDOManager;

  class ChildrenManager extends PDOManager
  {
    // Récupère les enfants d'un utilisateur
    public function getChildren($parentId)
    {
      $sql = "SELECT id, parentId, childName, DATE_FORMAT(birthday, '%d/%m/%Y') AS birthday_fr, note FROM children WHERE parentId = ? ORDER BY childName";

      $children = $this->executeRequest($sql, array($parentId));

      return $children;
    }

    // Ajouter un enfant
    public function addChild(Children $children)
    {
      $sql = "INSERT INTO children(parentId, childName, birthday, note) VALUES(?,?,?,?)";
      $newChild = $this->executeRequest($sql, array($children->parentId(), $children->childName(), $children->birthday(), $children->note()));

      return $newChild;
    }

    // Modifier un enfant
    public function updateChild(Children $children)
    {
      $sql = "UPDATE children SET parentId = ?, childName = ?, birthday = ?, note = ? WHERE id = ?";
      $updateChild = $this->executeRequest($sql, array($children->parentId(), $children->childName(), $children->birthday(), $children->note()));

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
