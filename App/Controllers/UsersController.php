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


    // AFFICHER L'ACCUEIL UTILISATEUR
    public function homeUser()
    {
      // SI compte administrateur
      if ($_SESSION['admin'] == 1) {
        // Récupère la liste de tous les enfants et des utilisateurs
        $children = $this->child->getAllChildren();
        $user = $this->users->getUsers();
      }
      // SINON récupère la liste des enfants de l'utilisateur
      else {
        $children = $this->child->getChildren($_SESSION['id']);
        $user = "";
      }

      // Affiche l'accueil utilisateur
      $view = new View("User");
      $view->generateView(array('children' => $children, 'user' => $user));
    }


    // VERIFIER L'UTILISATEUR ET LE MOT DE PASSE
    public function login($username, $password)
    {
      // Récupère un utilisateur
      $user = $this->users->getUser($username);

      // Vérifie que le mot de passe correspond
      $checkPassword = password_verify($password, $user['password']);
      // SI le mot de passe est bon
      if ($checkPassword) {
        // Enregistre les deonnées utilisateur dans la session
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];

        // Affiche la vue accueil utilisateur
          $this->homeUser();
      }
      // SINON affiche un message d'erreur
      else {
        $errorLogin = "Votre identifiant ou votre mot de passe est incorrect";

        // Affiche la vue Login
        $viewLogin = new View("Login");
        $viewLogin->generateView(array('errorLogin' => $errorLogin));
      }
    }


    // CREER UN UTILISATEUR
    public function createUser($username, $password, $admin)
    {
      // Récupère les données
      $newUser = new Users (['username' => $username, 'password' => $password, 'admin' => $admin]);

      // Crée l'utilisateur
      $this->users->addUser($newUser);
    }


    // MODIFIER LE MOT DE PASSE
    public function changeUser($oldPassword, $password1, $password2)
    {
      // Récupère les données de la session
      $id = $_SESSION['id'];
      $username = $_SESSION['username'];
      $admin = $_SESSION['admin'];

      // Récupère l'utilisateur
      $user = $this->users->getUser($username);

      // Vérifie que le mot de passe correspond
      $checkPassword = password_verify($oldPassword, $user['password']);
      // SI le mot de passe est bon
      if ($checkPassword) {
        // SI les nouveaux mots de passe correspondent
        if ($password1 == $password2) {
          // Récupère les données
          $userUpdate = new Users(['username' => $username, 'password' => $password1, 'admin' => $admin, 'id' => $id]);

          // Modifie le mot de passe
          $this->users->updateUser($userUpdate);

          // Affiche un message
          $updatePassword = "Votre mot de passe est modifier";
        }
        // SINON Affiche un message d'erreur
        else {
          $updatePassword = "Veuillez confirmer votre nouveau mot de passe";
        }
      }
      else {
        $updatePassword = "Votre identifiant ou votre mot de passe est incorrect";
      }
      // Affiche la vue LoginAdmin
      $viewLoginAdmin = new View("LoginAdmin");
      $viewLoginAdmin->generateView(array('updatePassword' => $updatePassword));
    }


    // EFFACER UN UTILISATEUR
    public function eraseUser($userId)
    {
      $this->users->deleteUser($userId);
    }


    // AFFICHER LA GESTION DES UTILISATEURS
    public function usersAdmin()
    {
      // Récupère les enfants et les utilisateurs
      $user = $this->users->getUsers();
      $children = $this->child->getAllChildren();

      // Affiche la vue UsersAdmin
      $view = new View("UsersAdmin");
      $view->generateView(array('user' => $user, 'children' => $children));
    }



    // DECONNECTER
    public function disconnect()
    {
      // Destruction de la session
      $_SESSION = array();
      session_destroy();

      // Suppression des cookies de connexion automatique
      setcookie('login', '');
      setcookie('pass_hache', '');
    }
  }
?>
