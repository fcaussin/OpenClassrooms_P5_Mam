<?php
  namespace App\Config;

  /**
   * Configuration des paramètres de connexion à la base de données
   */
  class Configuration
  {
    private static $parameters;


    // Renvoie le tableau des paramètres en le chargeant au besoin
    private static function getParameters()
    {
      if (self::$parameters == null) {
        $file = "../App/Config/config.ini";
        if (!file_exists($file)) {
          throw new \Exception("Auncun fichier de configuration trouvé");
        }
        else {
          self::$parameters = parse_ini_file($file);
        }
      }
      return self::$parameters;
    }

    // Renvoie la valeur d'un paramètre de configuration
    public static function get($name, $defaultValue = null)
    {
      if (isset(self::getParameters()[$name])) {
        $value = self::getParameters()[$name];
      }
      else {
        $value = $defaultValue;
      }
      return $value;
    }
  }
?>
