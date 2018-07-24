<?php
  namespace App\Controllers;

  use App\Models\ChildrenManager;
  use App\Models\Children;
  use App\Views\View;


  class ChildrenController
  {
    private $children;

    public function __construct()
    {
      $this->children = new ChildrenManager;
    }

    // Affiche un enfant
    public function childAdmin($childId)
    {
      $child = $this->children->getChild($childId);

      // Génère la vue adminChild
      $view = new View("adminChild");
      $view->generateView(array('child' => $child));
    }

    public function changeChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note, $id)
    {
      $childUpdate = new Children(['parentId' => $parentId, 'childName' => $childName, 'familyName' => $familyName, 'birthday' => $birthday, 'height' => $height, 'weight' => $weight, 'note' => $note, 'id' => $id]);
      $this->children->updateChild($childUpdate);
    }

    public function createChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note)
    {
      $newChild = new Children (['parentId' => $parentId, 'childName' => $childName, 'familyName' => $familyName, 'birthday' => $birthday, 'height' => $height, 'weight' => $weight, 'note' => $note]);
      $this->children->addChild($newChild);
    }

    public function eraseChild($id)
    {
      $this->children->deleteChild($id);
    }
  }
?>
