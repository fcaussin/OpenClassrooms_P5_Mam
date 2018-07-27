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

    // Affichage de l'accueil utilisateur
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

        // Affiche la vue Login
        $viewLogin = new View("Login");
        $viewLogin->generateView(array('errorLogin' => $errorLogin));
      }
    }

    public function createUser($username, $password, $admin)
    {
      $newUser = new Users (['username' => $username, 'password' => $password, 'admin' => $admin]);

      $this->users->addUser($newUser);
    }

    // Modification du mot de passe
    public function changeUser($oldPassword, $password1, $password2)
    {
      $id = $_SESSION['id'];
      $username = $_SESSION['username'];
      $admin = $_SESSION['admin'];

      // Récupère un utilisateur
      $user = $this->users->getUser($username);

      // Vérifie que le mot de passe correspond
      $checkPassword = password_verify($oldPassword, $user['password']);
      // Si le mot de passe est bon
      if ($checkPassword) {
        // Si les mots de passe correspondent
        if ($password1 == $password2) {

          $userUpdate = new Users(['username' => $username, 'password' => $password1, 'admin' => $admin, 'id' => $id]);
          // Modifie le mot de passe
          $this->users->updateUser($userUpdate);

          $updatePassword = "Votre mot de passe est modifier";
        }
        else {
          $updatePassword = "Veuillez confirmer votre nouveau mot de passe";
        }
      }
      else {
        $updatePassword = "Votre identifiant ou votre mot de passe est incorrect";
      }
      $viewLoginAdmin = new View("LoginAdmin");
      $viewLoginAdmin->generateView(array('updatePassword' => $updatePassword));
    }

    public function eraseUser($userId)
    {
      $this->users->deleteUser($userId);
    }

    // Affiche la vue gestion des utilisateurs
    public function usersAdmin()
    {
      $user = $this->users->getUsers();
      $children = $this->child->getAllChildren();

      $view = new View("UsersAdmin");
      $view->generateView(array('user' => $user, 'children' => $children));
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
