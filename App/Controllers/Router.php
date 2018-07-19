<?php
  namespace App\Controllers;

  use App\Views\View;

  class Router
  {
    private $viewHome;
    private $viewLogin;


    public function __construct()
    {
      $this->viewHome = new View("Home");
      $this->viewLogin = new View("Login");
    }


    // Traite une requête entrante
    public function routerRequest()
    {
      try {
        // Vérifie que la variable est définie
        if (isset($_GET['action'])) {
          switch ($_GET['action']) {
            case 'login':
              if (empty($_SESSION)) {
                $this->viewLogin->generateView("");
              }
              // Sinon affiche la page accueil d'administration
              else {
                //
                throw new \Exception("Page d'administration en construction");
                //
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
          $this->viewHome->generateView("");
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
