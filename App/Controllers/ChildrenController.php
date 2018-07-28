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


    // AFFICHE MODIFICATION D'UN ENFANT
    public function childAdmin($childId)
    {
      // Récupère l'enfant
      $child = $this->children->getChild($childId);

      // SI Administrateur ET enfant existe OU enfant appartient à l'utilisateur
      if (($_SESSION['admin'] == 1 && isset($child["id"])) || $child['parentId'] == $_SESSION['id'])
      {
        // Affiche la vue adminChild
        $view = new View("adminChild");
        $view->generateView(array('child' => $child));
      }
      // SINON Envoie un message d'erreur
      else {
        throw new \Exception("Cet enfant n'existe pas");
      }
    }


    // MODIFIER UN ENFANT
    public function changeChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note, $id)
    {
      // Récupère les données
      $childUpdate = new Children(['parentId' => $parentId, 'childName' => $childName, 'familyName' => $familyName, 'birthday' => $birthday, 'height' => $height, 'weight' => $weight, 'note' => $note, 'id' => $id]);

      // Modifie l'enfant
      $this->children->updateChild($childUpdate);
    }


    // CREER UN ENFANT
    public function createChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note)
    {
      // Récupère les données
      $newChild = new Children (['parentId' => $parentId, 'childName' => $childName, 'familyName' => $familyName, 'birthday' => $birthday, 'height' => $height, 'weight' => $weight, 'note' => $note]);

      // Créé l'enfant
      $this->children->addChild($newChild);
    }


    // EFFACER UN ENFANT
    public function eraseChild($childId)
    {
      $this->children->deleteChild($childId);
    }
  }
?>
