<?php
  namespace App\Config;

  use PDO;
  use App\Config\Configuration;

  /**
   * Gère la connexion à la base de donnée
   * Utilise l'API PDO de PHP
   */
  abstract class PDOManager
  {
    private static $db;

    // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
    private static function dbConnect()
    {
      if (self::$db == null) {
        // Récupération des paramètres de connexion à la BD
        $dsn = Configuration::get("dsn");
        $login = Configuration::get("login");
        $password = Configuration::get("password");

        // Création de la connexion
        self::$db = new PDO($dsn, $login, $password);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      }

      return self::$db;
    }

    // Execute une requête SQL paramétrée
    protected function executeRequest($sql, $vars = null)
    {
        // Exécution d'une requête préparée
        $req = self::dbConnect()->prepare($sql);
        $req->execute($vars);

      return $req;
    }
  }
?>
