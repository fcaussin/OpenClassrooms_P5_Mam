<?php
  namespace App\Models;


  class Users
  {
    private $id,
            $username,
            $password,
            $admin;

    public function hydrate($data)
    {
      foreach ($data as $key => $value) {
        $method = "set".ucfirst($key);

        if (method_exists($this, $method)) {
          $this->$method($value);
        }
      }
    }

    public function __construct(array $data =[])
    {
      if (!empty($data)) {
          $this->hydrate($data);
        }
    }

    // GETTERS

    public function id()
    {
      return $this->id;
    }

    public function username()
    {
      return $this->username;
    }

    public function password()
    {
      return $this->password;
    }

    public function admin()
    {
      return $this->admin;
    }

    // SETTERS

    public function setId($id)
    {
      $this->id = (int) $id;
    }

    public function setUsername($username)
    {
      if (is_string($username)) {
        $this->username = $username;
      }
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setAdmin($admin)
    {
      $this->admin = (int) $admin;
    }
  }
?>
