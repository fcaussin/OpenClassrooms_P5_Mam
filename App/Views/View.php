<?php
  namespace App\Views;

  class View
  {
    // Nom du fichier associé à la vue
    private $file;
    // Titre de la vue
    private $title;

    public function __construct($action)
    {
      // Détermination du nom du fichier vue à partir de l'action
      $this->file = "../App/Views/view" . $action . ".php";
    }

    // Génère un fichier vue et renvoie le résultat
    public function generateFile($file, $data)
    {
      if (file_exists($file)) {
        // Si le fichier existe, rend les éléments du tableau $data accessibles dans la vue
        extract($data);
        // Démarrage de la tamporisation de sortie
        ob_start();
        // Inclut le fichier vue, son résultat est placé dans le tampon de sortie
        require $file;
        // Arrêt de la tamporisation et renvoi du tampon de sortie
        return ob_get_clean();
      }
      else {
        throw new \Exception("Fichier " . $file . " introuvable");
      }
    }

    // Génère et affiche la vue
    public function generateView($data)
    {
      // Génération de la partie spécifique de la vue
      $content = $this->generateFile($this->file, $data);
      // Génération du template commun utilisant la partie spécifique
      $view = $this->generateFile("../App/Views/template.php", array("title" => $this->title, "content" => $content));
      // Renvoie de la vue au navigateur
      echo $view;
    }
  }
?>
