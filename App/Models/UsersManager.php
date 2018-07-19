<?php
  namespace App\Models;

  use App\Config\PDOManager;


  class UsersManager extends PDOManager
  {
    // Récupère les données d'un utilisateur
    public function getUser($username)
    {
      $sql = "SELECT id, username, password, admin FROM users WHERE username = ?";
      $req = $this->executeRequest($sql, array($username));
      $user = $req->fetch();

      return $user;
    }

    // Récupère la liste des parents
    public function getUsers()
    {
      $sql = "SELECT id, username, password, admin FROM users";
      $users = $this->executeRequest($sql);

      return $users;
    }

    // Ajoute un utilisateur
    public function addUser(Users $users)
    {
      $sql = "INSERT INTO users(username, password, admin) VALUES(?,?,NULL)";
      $newUser = $this->executeRequest($sql, array($users->username(), $users->password()));

      return $newUser;
    }

    // Modifie l'utilisateur
    public function updateUser(Users $users)
    {
      $sql = "UPDATE users SET password = ?, username = ? WHERE id = ?";
      $newPassword = $this->executeRequest($sql, array($users->password(), $users->username(), $users->id()));

      return $newPassword;
    }

    // Efface un utilisateur
    public function deleteUser($id)
    {
      $sql = "DELETE FROM users WHERE id = ?";
      $this->executeRequest($sql, array($id));
    }
  }
?>
