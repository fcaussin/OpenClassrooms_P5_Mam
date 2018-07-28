<?php
  namespace App\Models;

  use App\Config\PDOManager;


  class UsersManager extends PDOManager
  {

    // RECUPERER UN UTILISATEUR
    public function getUser($username)
    {
      $sql = "SELECT id, username, password, admin FROM users WHERE username = ?";
      $req = $this->executeRequest($sql, array($username));
      $user = $req->fetch();

      return $user;
    }


    // RECUPERER LA LISTE DES UTILISATEURS
    public function getUsers()
    {
      $sql = "SELECT id, username, password, admin FROM users";
      $users = $this->executeRequest($sql);

      return $users;
    }


    // AJOUTER UN UTILISATEUR
    public function addUser(Users $users)
    {
      $sql = "INSERT INTO users(username, password, admin) VALUES(?,?,?)";
      $newUser = $this->executeRequest($sql, array($users->username(), $users->password(), $users->admin()));

      return $newUser;
    }


    // MODIFIER UN UTILISATEUR
    public function updateUser(Users $users)
    {
      $sql = "UPDATE users SET username = ?, password = ?, admin = ?  WHERE id = ?";
      $newPassword = $this->executeRequest($sql, array($users->username(), $users->password(), $users->admin(), $users->id()));

      return $newPassword;
    }


    // EFFACER UN UTILISATEUR
    public function deleteUser($id)
    {
      $sql = "DELETE FROM users WHERE id = ?";
      $this->executeRequest($sql, array($id));
    }
  }
?>
