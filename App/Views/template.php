<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="La M.A.M. des Poussins accueille vos enfants et offre tout le confort nécessaire pour qu'ils se sentent comme à la maison">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>

    <title> <?= $title ?> </title>
  </head>

  <body>
    <nav class="white" role="navigation">
      <div class="nav-wrapper container">
        <a href="index.php" id="logo-container" class="brand-logo"><img src="img/logo2.png" alt="logo" class="logo"></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Accueil</a></li>
          <li><a href="#contact">Contact</a></li>
          <!-- Si pas de session affiche se connecter -->
          <?php if (empty($_SESSION)) {?>
            <li><a href="index.php?action=login">Se Connecter</a></li>

          <!-- Sinon affiche l'utilisateur et le lien de déconnexion -->
          <?php } else { ?>
            <li><a href="index.php?action=login"><?= $_SESSION['username']; ?></a></li>
            <li><a href="index.php?action=disconnect">Se déconnecter</a></li>
          <?php } ?>
        </ul>

        <ul id="nav-mobile" class="sidenav deep-orange lighten-2">
          <li><a href="index.php" class="white-text">Accueil</a></li>
          <li><a href="#contact" class="white-text">Contact</a></li>
          <!-- Si pas de session affiche se connecter -->
          <?php if (empty($_SESSION)) {?>
            <li><a href="index.php?action=login" class="white-text">Se Connecter</a></li>

          <!-- Sinon affiche l'utilisateur et le lien de déconnexion -->
          <?php } else { ?>
            <li><a href="index.php?action=login" class="white-text"><?= $_SESSION['username']; ?></a></li>
            <li><a href="index.php?action=disconnect" class="white-text">Se déconnecter</a></li>
          <?php } ?>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger orange-text text-lighten-2"><i class="material-icons">menu</i></a>
      </div>
    </nav>


    <?= $content ?>


    <div class="parallax-container valign-wrapper">
      <div class="parallax"><img src="img/enfant2.jpg" alt="Photo d'enfant"></div>
    </div>


    <div class="container">
      <div class="section contact" id="contact">

        <div class="row">
          <div class="col s12 center">
            <h4>Contactez-nous</h4>
            <p class="center-align light">Vous avez des questions ou besoins de plus d'informations. N'hésitez pas à nous contacter par mail :</p>
          </div>
          <form class="col s12 center" action="mailto:fabien.caussin@free.fr">
            <button class="btn waves-effect waves-light deep-orange lighten-2" type="submit" name="action">Contact
              <i class="material-icons right">email</i>
            </button>
          </form>
        </div>
      </div>
    </div>


    <footer class="page-footer deep-orange lighten-2">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Maison d'Assistantes Maternelles des Poussins</h5>
          </div>

          <div class="col l3 s12">
          </div>

          <div class="col l3 s12">
            <p class="grey-text text-lighten-4"><i class="tiny material-icons">home</i>  Route de Nice 06650 Opio<br />
              <i class="tiny material-icons">call</i>  04.01.01.01.01.<br />
            </p>
          </div>
        </div>
      </div>

      <div class="footer-copyright">
        <div class="container">
          Made by <a class="blue-text text-lighten-3" href="https://github.com/fcaussin">Fabien Caussin</a>
        </div>
      </div>
    </footer>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
  </body>
</html>
