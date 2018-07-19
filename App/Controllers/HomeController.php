<?php
  namespace App\Controllers;

  use App\Views\View;


  class HomeController
  {
    private $article;


    public function __construct()
    {
    }


    // Affiche l'accueil du site
    public function home()
    {
      $view = new View("Home");
      $view->generateView(array());
    }
  }
?>
