<?php
  namespace App\Controllers;

  use App\Views\View;
  use App\Controllers\UsersController;
  use App\Controllers\ChildrenController;

  class Router
  {
    private $viewHome;
    private $viewLogin;
    private $viewLoginAdmin;
    private $ctrlUsers;
    private $ctrlChildren;
    private $ctrlReport;


    public function __construct()
    {
      $this->viewHome = new View("Home");
      $this->viewLogin = new View("Login");
      $this->viewLoginAdmin = new View("LoginAdmin");
      $this->ctrlUsers = new UsersController;
      $this->ctrlChildren = new ChildrenController;
      $this->ctrlReport = new ReportController;
    }


    // Traite une requête entrante
    public function routerRequest()
    {
      try {
        // Vérifie que la variable est définie
        if (isset($_GET['action'])) {
          switch ($_GET['action']) {

            // Requête affichage de formulaire de connexion si session vide
            case 'login':
              if (empty($_SESSION)) {
                $errorLogin = "";
                $this->viewLogin->generateView(array('errorLogin' => $errorLogin));
              }
              // Sinon affiche la page d'accueil utilisateur
              else {
                  $this->ctrlUsers->homeUser();
              }
            break;

            // Requête connexion à la partie utilisateur
            case 'userLogin':
              // Récupère les paramètres
              $username = $this->getParameter($_POST, 'username');
              $password = $this->getParameter($_POST, 'password');
              // Vérification des données de Connexion
              $this->ctrlUsers->Login($username, $password);
            break;

            // Requête affichage page modification mot de passe
            case 'loginAdmin':
              if (isset($_SESSION['id'])) {
                $updatePassword = "";
                $this->viewLoginAdmin->generateView(array('updatePassword' => $updatePassword));
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            // Requête modification mot de passe
            case 'updateLogin':
              if (isset($_SESSION['id'])) {
                $oldPassword = $this->getParameter($_POST, 'oldPassword');
                $password1 = $this->getParameter($_POST, 'password1');
                $password2 = $this->getParameter($_POST, 'password2');

                $this->ctrlUsers->changeUser($oldPassword, $password1, $password2);
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            // Requête affichage gestion utilisateur
            case 'usersAdmin':
              if (isset($_SESSION['admin']) == 1) {
                $this->ctrlUsers->usersAdmin();
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête création d'un utilisateur
            case 'createUser':
              if (isset($_SESSION['admin']) == 1) {
                $username = $this->getParameter($_POST, 'username');
                $password = $this->getParameter($_POST, 'password');
                $admin = intval($this->getParameter($_POST, 'admin'));

                $this->ctrlUsers->createUser($username, $password, $admin);

                $this->ctrlUsers->usersAdmin();
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaire");

              }
            break;

            // Requête de suppression d'un utilisateur
            case 'deleteUser':
              if (isset($_SESSION['admin']) == 1) {
                $userId = intval($this->getParameter($_POST, 'userId'));
                // Si l'id de l'utilisateur est valide on le supprime
                if ($userId != $_SESSION['id']) {
                  $this->ctrlUsers->eraseUser($userId);

                  $this->ctrlUsers->usersAdmin();
                }
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête deconnexion
            case 'disconnect':
              $this->ctrlUsers->disconnect();
              // Retour à la page d'accueil après déconnexion
              $this->viewHome->generateView(array());
            break;

            // Requête affichage administration enfant
            case 'childAdmin':
              if (isset($_SESSION['id'])) {
                $childId = intval($this->getParameter($_GET, 'id'));
                if ($childId > 0) {
                $this->ctrlChildren->childAdmin($childId);
                }
                else {
                  throw new \Exception("Identifiant de l'enfant non valide");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            // Requête création d'un enfant
            case 'createChild':
              if (isset($_SESSION['admin']) == 1) {
                $parentId = intval($this->getParameter($_POST, 'parentId'));
                $childName = $this->getParameter($_POST, 'childName');
                $familyName = $this->getParameter($_POST, 'familyName');
                $birthday = $this->getParameter($_POST, 'birthday');
                $birthday = date('Y-m-d', strtotime($birthday));
                $height = $this->getParameter($_POST, 'height');
                $weight = $this->getParameter($_POST, 'weight');
                $note = $this->getParameter($_POST, 'note');

                $this->ctrlChildren->createChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note);

                // Affiche la page d'accueil utilisateur
                $this->ctrlUsers->homeUser();
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête de modification d'un enfant
            case 'updateChild':
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $id = intval($this->getParameter($_POST, 'childId'));
                $parentId = intval($this->getParameter($_POST, 'parentId'));
                $childName = $this->getParameter($_POST, 'childName');
                $familyName = $this->getParameter($_POST, 'familyName');
                $birthday = $this->getParameter($_POST, 'birthday');
                $birthday = date('Y-m-d', strtotime($birthday));
                $height = $this->getParameter($_POST, 'height');
                $weight = $this->getParameter($_POST, 'weight');
                $note = $this->getParameter($_POST, 'note');

                // Modifie un enfant
                $this->ctrlChildren->changeChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note, $id);

                // Affiche la page d'accueil utilisateur
                $this->ctrlUsers->homeUser();
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            // Requête de suppression d'un enfant
            case 'deleteChild':
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les paramètres
                $id_Get = intval($this->getParameter($_GET, 'id'));
                $childId = intval($this->getParameter($_POST,'childId'));
                // Si id de l'enfant est valide on le supprime
                if ($id_Get == $childId) {
                  $this->ctrlChildren->eraseChild($childId);

                  //Affiche la page d'accueil utilisateur
                  $this->ctrlUsers->homeUser();
                }
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête d'affichage du dernier rapport
            case 'lastReport':
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $parentId = intval($this->getParameter($_GET, 'parentId'));
                $childId = intval($this->getParameter($_GET, 'id'));
                // Si id parent valide ou administrateur on affiche le rapport
                if (($_SESSION['id'] == $parentId) OR ($_SESSION['admin'] == 1)){
                  $this->ctrlReport->lastChildReport($childId);
                }
                else {
                  throw new \Exception("Vous n'avez pas les droits nécessaires");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            // Requête d'affichage d'un rapport
            case 'reportById':
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $parentId = intval($this->getParameter($_GET, 'parentId'));
                $childId = intval($this->getParameter($_GET, 'id'));
                $reportId = intval($this->getParameter($_GET, 'reportId'));
                // Si id parent valide ou administrateur on affiche le rapport
                if (($_SESSION['id'] == $parentId) OR ($_SESSION['admin'] == 1)){
                  $this->ctrlReport->childReport($childId, $reportId);
                }
                else {
                  throw new \Exception("Vous n'avez pas les droits nécessaires");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            // Requête d'affichage de la liste des rapports par mois
            case 'listReportByMonth':
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $parentId = intval($this->getParameter($_GET, 'parentId'));
                $childId = intval($this->getParameter($_GET, 'id'));
                // Si id parent valide ou administrateur on affiche les rapport
                if (($_SESSION['id'] == $parentId) OR ($_SESSION['admin'] == 1)){
                  $this->ctrlReport->listReportsByMonth($childId);
                }
                else {
                  throw new \Exception("Vous n'avez pas les droits nécessaires");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;

            //Requête d'affichage de la liste des rapports du mois
            case 'listReports':
            if (isset($_SESSION['id'])) {
              // Récupère les paramètres
              $parentId = intval($this->getParameter($_GET, 'parentId'));
              $childId = intval($this->getParameter($_GET, 'id'));
              $monthId = intval($this->getParameter($_GET, 'monthId'));
              if (($_SESSION['id'] == $parentId) OR ($_SESSION['admin'] == 1)) {
                $this->ctrlReport->listReports($childId, $monthId);
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            }
            else {
              throw new \Exception("Vous n'êtes pas connecté");
            }
            break;

            // Requête afficher page création d'un nouveau rapport
            case 'newReport':
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les paramètres
                $childId = intval($this->getParameter($_GET, 'id'));

                $this->ctrlReport->newReport($childId);
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête de création d'un nouveau rapport
            case 'createReport':
              if (isset($_SESSION['admin']) == 1) {
                $childId = intval($this->getParameter($_POST, 'childId'));
                $dateReport = $this->getParameter($_POST, 'dateReport');
                $dateReport = date('Y-m-d', strtotime($dateReport));
                $behavior = $this->getParameter($_POST, 'behavior');
                $comments = $this->getParameter($_POST, 'comments');
                $activities = $this->getParameter($_POST, 'activities');
                $meal = $this->getParameter($_POST, 'meal');
                $nap = $this->getParameter($_POST, 'nap');
                $info = $this->getParameter($_POST, 'info');

                $this->ctrlReport->createReport($childId, $dateReport, $behavior, $comments, $activities, $meal, $nap, $info);
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête de suppression d'un rapport
            case 'deleteReport':
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les paramètres
                $id_Get = intval($this->getParameter($_GET, 'id'));
                $reportId = intval($this->getParameter($_POST, 'reportId'));
                // Si id du rapport est valide on supprime
                if ($id_Get == $reportId) {
                  $this->ctrlReport->eraseReport($reportId);

                  // Affiche la page d'accueil utilisateur
                  $this->ctrlUsers->homeUser();
                }
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête affichage administration rapport
            case 'reportAdmin':
              if (isset($_SESSION['admin']) == 1) {
                $reportId = intval($this->getParameter($_GET, 'id'));
                $childId = intval($this->getParameter($_GET, 'childId'));
                if ($reportId > 0) {
                  $this->ctrlReport->reportAdmin($reportId, $childId);
                }
                else {
                  throw new \Exception("Identifiant du rapport non valide");
                }
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Requête de modification d'un rapport
            case 'updateReport':
              if (isset($_SESSION['admin']) == 1) {
                $id = intval($this->getParameter($_POST, 'reportId'));
                $childId = intval($this->getParameter($_POST, 'childId'));
                $dateReport = $this->getParameter($_POST, 'dateReport');
                $dateReport = date('Y-m-d', strtotime($dateReport));
                $behavior = $this->getParameter($_POST, 'behavior');
                $comments = $this->getParameter($_POST, 'comments');
                $activities = $this->getParameter($_POST, 'activities');
                $meal = $this->getParameter($_POST, 'meal');
                $nap = $this->getParameter($_POST, 'nap');
                $info = $this->getParameter($_POST, 'info');

                $this->ctrlReport->changeReport($childId, $dateReport, $behavior, $comments, $activities, $meal, $nap, $info, $id);
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // Sinon envoie un message d'erreur
            default:
              throw new \Exception("Action non valide");
            break;
          }
        }
        // Si aucune action définie: affichage de l'accueil
        else {
          $this->viewHome->generateView(array());
        }
      }
      // Affichage du message d'erreur
      catch (\Exception $e) {
        $this->error($e->getMessage());
      }
    }

    // Génère la vue du message d'erreur
    private function error($msgError)
    {
      $view = new View("Error");
      $view->generateView(array('msgError' => $msgError));
    }


    // Recherche un paramètre dans un tableau
    private function getParameter($table, $name)
    {
      // Si le parmètre existe
      if (isset($table[$name])) {
        // Nettoie la valeur entrée par l'utilisateur
        return htmlspecialchars($table[$name]);
      }
      else {
        throw new \Exception("Paramètre " . $name . " absent");
      }
    }
  }
?>
