<?php
  namespace App\Controllers;

  use App\Views\View;
  use App\Controllers\UsersController;
  use App\Controllers\ChildrenController;

  class Router
  {
    private $viewHome;
    private $viewLogin;
    private $ctrlUsers;
    private $ctrlChildren;


    public function __construct()
    {
      $this->viewHome = new View("Home");
      $this->viewLogin = new View("Login");
      $this->ctrlUsers = new UsersController;
      $this->ctrlChildren = new ChildrenController;
    }


    // Traite une requête entrante
    public function routerRequest()
    {
      try {
        // Vérifie que la variable est définie
        if (isset($_GET['action'])) {
          switch ($_GET['action']) {

            // Requête affichage de formulaire de connexion si session vide
            case 'login':
              if (empty($_SESSION)) {
                $errorLogin = "";
                $this->viewLogin->generateView(array('errorLogin' => $errorLogin));
              }
              // Sinon affiche la page d'accueil utilisateur
              else {
                  $this->ctrlUsers->homeUser();
              }
            break;

            // Requête connexion à la partie utilisateur
            case 'userLogin':
              // Récupère les paramètres
              $username = $this->getParameter($_POST, 'username');
              $password = $this->getParameter($_POST, 'password');
              // Vérification des données de Connexion
              $this->ctrlUsers->Login($username, $password);
            break;

            case 'disconnect':
              $this->ctrlUsers->disconnect();
              // Retour à la page d'accueil après déconnexion
              $this->viewHome->generateView(array());
            break;

            // Requête affichage administration enfant
            case 'childAdmin':
              if (isset($_SESSION['id'])) {
                $childId = intval($this->getParameter($_GET, 'id'));
                if ($childId != 0) {
                $this->ctrlChildren->childAdmin($childId);
                }
                else {
                  throw new \Exception("Identifiant de l'enfant non valide");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            // Requête création d'un enfant
            case 'createChild':
              if (isset($_SESSION['admin']) == 1) {
                $parentId = intval($this->getParameter($_POST, 'parentId'));
                $childName = $this->getParameter($_POST, 'childName');
                $familyName = $this->getParameter($_POST, 'familyName');
                $birthday = $this->getParameter($_POST, 'birthday');
                $birthday = date('Y-m-d', strtotime($birthday));
                $height = $this->getParameter($_POST, 'height');
                $weight = $this->getParameter($_POST, 'weight');
                $note = $this->getParameter($_POST, 'note');

                $this->ctrlChildren->createChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note);

                // Affiche la page d'accueil utilisateur
                $this->ctrlUsers->homeUser();
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête de modification d'un enfant
            case 'updateChild':
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $id = intval($this->getParameter($_POST, 'idChild'));
                $parentId = intval($this->getParameter($_POST, 'parentId'));
                $childName = $this->getParameter($_POST, 'childName');
                $familyName = $this->getParameter($_POST, 'familyName');
                $birthday = $this->getParameter($_POST, 'birthday');
                $birthday = date('Y-m-d', strtotime($birthday));
                $height = $this->getParameter($_POST, 'height');
                $weight = $this->getParameter($_POST, 'weight');
                $note = $this->getParameter($_POST, 'note');

                // Modifie un enfant
                $this->ctrlChildren->changeChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note, $id);

                // Affiche la page d'accueil utilisateur
                $this->ctrlUsers->homeUser();
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            case 'deleteChild':
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les paramètres
                $id_Get= intval($this->getParameter($_GET, 'id'));
                $id = intval($this->getParameter($_POST,'idChild'));
                // Si id de l'article est valide on le supprime
                if ($id_Get == $id) {
                  $this->ctrlChildren->eraseChild($id);

                  //Affiche la page d'accueil utilisateur
                  $this->ctrlUsers->homeUser();
                }
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }

            break;

            // Sinon envoie un message d'erreur
            default:
              throw new \Exception("Action non valide");
            break;
          }
        }
        // Si aucune action définie: affichage de l'accueil
        else {
          $this->viewHome->generateView(array());
        }
      }
      // Affichage du message d'erreur
      catch (\Exception $e) {
        $this->error($e->getMessage());
      }
    }

    // Génère la vue du message d'erreur
    private function error($msgError)
    {
      $view = new View("Error");
      $view->generateView(array('msgError' => $msgError));
    }


    // Recherche un paramètre dans un tableau
    private function getParameter($table, $name)
    {
      // Si le parmètre existe
      if (isset($table[$name])) {
        // Nettoie la valeur entrée par l'utilisateur
        return htmlspecialchars($table[$name]);
      }
      else {
        throw new \Exception("Paramètre " . $name . " absent");
      }
    }
  }
?>
