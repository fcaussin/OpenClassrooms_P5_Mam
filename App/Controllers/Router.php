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


    // TRAITE UNE REQUETE ENTRANTE
    public function routerRequest()
    {
      try {
        // Vérifie que la variable est définie
        if (isset($_GET['action'])) {
          switch ($_GET['action']) {


            // REQUETE AFFICHER FORMULAIRE DE CONNEXION
            case 'login':
              // SI Pas sonnecté
              if (empty($_SESSION)) {
                // Affiche le formulaire de connexion
                $errorLogin = "";
                $this->viewLogin->generateView(array('errorLogin' => $errorLogin));
              }
              // SINON affiche la page d'accueil utilisateur
              else {
                  $this->ctrlUsers->homeUser();
              }
            break;


            // REQUETE CONNEXION UTILISATEUR ET AFFICHAGE DE L'ACCUEIL
            case 'userLogin':
              // Récupère les paramètres
              $username = $this->getParameter($_POST, 'username');
              $password = $this->getParameter($_POST, 'password');
              // Vérification des données de Connexion
              $this->ctrlUsers->Login($username, $password);
            break;


            // REQUETE AFFICHER PAGE MODIFICATION MOT DE PASSE
            case 'loginAdmin':
              // SI Connecté
              if (isset($_SESSION['id'])) {
                $updatePassword = "";
                // Affiche la page
                $this->viewLoginAdmin->generateView(array('updatePassword' => $updatePassword));
              }
              // SINON Envoie une message d'erreur
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;


            // REQUETE MODIFIER MOT DE PASSE
            case 'updateLogin':
              // SI Connecté
              if (isset($_SESSION['id'])) {
                // Récupère les données
                $oldPassword = $this->getParameter($_POST, 'oldPassword');
                $password1 = $this->getParameter($_POST, 'password1');
                $password2 = $this->getParameter($_POST, 'password2');

                // Modifie le mot de passe
                $this->ctrlUsers->changeUser($oldPassword, $password1, $password2);
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;


            // REQUETE AFFICHER PAGE GESTION UTILISATEUR
            case 'usersAdmin':
              // SI Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Affiche la page
                $this->ctrlUsers->usersAdmin();
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;


            // REQUETE CREER UN UTILISATEUR
            case 'createUser':
              // SI Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les données
                $username = $this->getParameter($_POST, 'username');
                $password = $this->getParameter($_POST, 'password');
                $admin = intval($this->getParameter($_POST, 'admin'));

                // Créé l'utilisateur
                $this->ctrlUsers->createUser($username, $password, $admin);

                // Affiche la page gestion utilisateurs
                $this->ctrlUsers->usersAdmin();
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaire");
              }
            break;


            // REQUETE SUPPRIMER UN UTILISATEUR
            case 'deleteUser':
              // SI Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les données
                $userId = intval($this->getParameter($_POST, 'userId'));

                // SI l'id de l'utilisateur est valide
                if ($userId != $_SESSION['id']) {
                  // Supprime l'utilisateur
                  $this->ctrlUsers->eraseUser($userId);

                  // Affiche  page gestion utilisateurs
                  $this->ctrlUsers->usersAdmin();
                }
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;


            // REQUETE DECONNECTER
            case 'disconnect':
              // Déconnecte l'utilisateur
              $this->ctrlUsers->disconnect();
              // Affiche la page principale
              $this->viewHome->generateView(array());
            break;


            // REQUETE AFFICHER MODIFICATION ENFANT
            case 'childAdmin':
              // SI Connecté
              if (isset($_SESSION['id'])) {
                // Récupère l'ID de l'enfant
                $childId = intval($this->getParameter($_GET, 'id'));

                // SI l'ID supperieur à 0
                if ($childId > 0) {
                // Affiche la page
                $this->ctrlChildren->childAdmin($childId);
                }
                // SINON Envoie un message d'erreur
                else {
                  throw new \Exception("Identifiant de l'enfant non valide");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;


            // REQUETE CREER UN ENFANT
            case 'createChild':
              // SI Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les données
                $parentId = intval($this->getParameter($_POST, 'parentId'));
                $childName = $this->getParameter($_POST, 'childName');
                $familyName = $this->getParameter($_POST, 'familyName');
                $birthday = $this->getParameter($_POST, 'birthday');
                $birthday = date('Y-m-d', strtotime($birthday));
                $height = $this->getParameter($_POST, 'height');
                $weight = $this->getParameter($_POST, 'weight');
                $note = $this->getParameter($_POST, 'note');

                // Créé l'enfant
                $this->ctrlChildren->createChild($parentId, $childName, $familyName, $birthday, $height, $weight, $note);

                // Affiche la page d'accueil utilisateur
                $this->ctrlUsers->homeUser();
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;


            // REQUETE MODIFIER UN ENFANT
            case 'updateChild':
              // SI Connecté
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
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;


            // REQUETE SUPPRIMER UN ENFANT
            case 'deleteChild':
              // SI Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les paramètres
                $id_Get = intval($this->getParameter($_GET, 'id'));
                $childId = intval($this->getParameter($_POST,'childId'));

                // SI id de l'enfant est valide
                if ($id_Get == $childId) {
                  // Supprime l'enfant
                  $this->ctrlChildren->eraseChild($childId);

                  //Affiche la page d'accueil utilisateur
                  $this->ctrlUsers->homeUser();
                }
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;


            // REQUETE AFFICHER DERNIER RAPPORT
            case 'lastReport':
              // SI Connecté
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $parentId = intval($this->getParameter($_GET, 'parentId'));
                $childId = intval($this->getParameter($_GET, 'id'));

                // Si id parent valide OU administrateur
                if (($_SESSION['id'] == $parentId) OR ($_SESSION['admin'] == 1)){
                  // Affiche le dernier rapport
                  $this->ctrlReport->lastChildReport($childId);
                }
                // Sinon Envoie un message d'erreur
                else {
                  throw new \Exception("Vous n'avez pas les droits nécessaires");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;


            // REQUETE AFFICHER UN RAPPORT
            case 'reportById':
              // SI Connecté
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $parentId = intval($this->getParameter($_GET, 'parentId'));
                $childId = intval($this->getParameter($_GET, 'id'));
                $reportId = intval($this->getParameter($_GET, 'reportId'));

                // Si id parent valide ou administrateur
                if (($_SESSION['id'] == $parentId) OR ($_SESSION['admin'] == 1)){
                  // Affiche le rapport
                  $this->ctrlReport->childReport($childId, $reportId);
                }
                // SINON Envoie un message d'erreur
                else {
                  throw new \Exception("Vous n'avez pas les droits nécessaires");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;


            // REQUETE AFFICHER LISTE DES RAPPORTS PAR MOIS
            case 'listReportByMonth':
              // SI Connecté
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $parentId = intval($this->getParameter($_GET, 'parentId'));
                $childId = intval($this->getParameter($_GET, 'id'));

                // Si id parent valide ou administrateur
                if (($_SESSION['id'] == $parentId) OR ($_SESSION['admin'] == 1)){
                  // Affiche les rapports
                  $this->ctrlReport->listReportsByMonth($childId);
                }
                // SINON Envoie un message d'erreur
                else {
                  throw new \Exception("Vous n'avez pas les droits nécessaires");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;


            // REQUETE AFFICHER LES RAPPORTS D'UN MOIS
            case 'listReports':
              // SI Connecté
              if (isset($_SESSION['id'])) {
                // Récupère les paramètres
                $parentId = intval($this->getParameter($_GET, 'parentId'));
                $childId = intval($this->getParameter($_GET, 'id'));
                $monthId = intval($this->getParameter($_GET, 'monthId'));

                // SI ID Parent valide ou Administrateur
                if (($_SESSION['id'] == $parentId) OR ($_SESSION['admin'] == 1)) {
                  // Affiche les rapports
                  $this->ctrlReport->listReports($childId, $monthId);
                }
                // SINON Envoie un message d'erreur
                else {
                  throw new \Exception("Vous n'avez pas les droits nécessaires");
                }
              }
              else {
                throw new \Exception("Vous n'êtes pas connecté");
              }
            break;


            // REQUETE AFFICHER CREATION NOUVEAU RAPPORT
            case 'newReport':
              // SI Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les paramètres
                $childId = intval($this->getParameter($_GET, 'id'));

                // Affiche la page
                $this->ctrlReport->newReport($childId);
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;


            // REQUETE CREER UN RAPPORT
            case 'createReport':
              // SI Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Réqupère les données
                $childId = intval($this->getParameter($_POST, 'childId'));
                $dateReport = $this->getParameter($_POST, 'dateReport');
                $dateReport = date('Y-m-d', strtotime($dateReport));
                $behavior = $this->getParameter($_POST, 'behavior');
                $comments = $this->getParameter($_POST, 'comments');
                $activities = $this->getParameter($_POST, 'activities');
                $meal = $this->getParameter($_POST, 'meal');
                $nap = $this->getParameter($_POST, 'nap');
                $info = $this->getParameter($_POST, 'info');

                // Créé le rapport
                $this->ctrlReport->createReport($childId, $dateReport, $behavior, $comments, $activities, $meal, $nap, $info);
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;


            // REQUETE SUPPRIMER UN RAPPORT
            case 'deleteReport':
              // Si Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les paramètres
                $id_Get = intval($this->getParameter($_GET, 'id'));
                $reportId = intval($this->getParameter($_POST, 'reportId'));

                // SI id du rapport est valide
                if ($id_Get == $reportId) {
                  // Supprime le rapport
                  $this->ctrlReport->eraseReport($reportId);

                  // Affiche la page d'accueil utilisateur
                  $this->ctrlUsers->homeUser();
                }
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;


            // REQUETE AFFICHER MODIFICATION RAPPORT
            case 'reportAdmin':
              // SI Administration
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les paramètres
                $reportId = intval($this->getParameter($_GET, 'id'));
                $childId = intval($this->getParameter($_GET, 'childId'));

                // SI ID Rapport suppérieur à 0
                if ($reportId > 0) {
                  // Affiche la page
                  $this->ctrlReport->reportAdmin($reportId, $childId);
                }
                // SINON Envoie un message erreur
                else {
                  throw new \Exception("Identifiant du rapport non valide");
                }
              }
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;


            // REQUETE MODIFIER RAPPORT
            case 'updateReport':
              // SI Administrateur
              if (isset($_SESSION['admin']) == 1) {
                // Récupère les données
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

                // Modifie le rapport
                $this->ctrlReport->changeReport($childId, $dateReport, $behavior, $comments, $activities, $meal, $nap, $info, $id);
              }
              // SINON Envoie un message d'erreur
              else {
                throw new \Exception("Vous n'avez pas les droits nécessaires");
              }
            break;

            // SINON envoie un message d'erreur
            default:
              throw new \Exception("Action non valide");
            break;
          }
        }
        // SI aucune action définie: affichage de l'accueil
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
