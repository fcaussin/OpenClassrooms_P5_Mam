<?php
  namespace App\Controllers;

  use App\Models\UsersManager;
  use App\Models\Users;
  use App\Models\ChildrenManager;
  use App\Views\View;

  class UsersController
  {
    private $users;
    private $child;


    public function __construct()
    {
      $this->users = new UsersManager;
      $this->child = new ChildrenManager;
    }

    public function homeUser()
    {
      // Si compte administrateur
      if ($_SESSION['admin'] == 1) {
        // Récupère la liste de tous les enfants
        $children = $this->child->getAllChildren();
        $user = $this->users->getUsers();
      } else {
        // Récupère la liste des efants de l'utilisateur
        $children = $this->child->getChildren($_SESSION['id']);
        $user = "";
      }

      // Affiche l'accueil utilisateur
      $view = new View("User");
      $view->generateView(array('children' => $children, 'user' => $user));
    }


    // Vérification de l'utilisateur et du mot de passe
    public function login($username, $password)
    {
      // Récupère un utilisateur
      $user = $this->users->getUser($username);

      // Vérifie que le mot de passe correspond
      $checkPassword = password_verify($password, $user['password']);
      // Si le mot de passe est bon
      if ($checkPassword) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];

        // Affiche la vue accueil administrateur ou utilisateu
          $this->homeUser();
      }
      // Sinon affiche un message d'erreur
      else {
        $errorLogin = "Votre identifiant ou votre mot de passe est incorrect";

        $viewLogin = new View("Login");
        $viewLogin->generateView(array('errorLogin' => $errorLogin));
      }
    }

    // Destruction de la session à la déconnexion
    public function disconnect()
    {
      $_SESSION = array();
      session_destroy();

      // Suppression des cookies de connexion automatique
      setcookie('login', '');
      setcookie('pass_hache', '');
    }

  }
?>
