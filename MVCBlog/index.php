<?php

//Page principale
require_once('models/connection.php');

session_start();

if (array_key_exists('login', $_SESSION)) {
  if (isset($_GET['controller']) && isset($_GET['action'])) {
      //On récupère les paramètres dans l'url...
      $controller = $_GET['controller'];
      $action = $_GET['action'];
  } else {
      //... sinon on donne des valeurs par défaut
      $controller = 'pages';
      $action = 'home';
  }

  require_once('views/layout.php');
}
else {
  if (array_key_exists('login', $_POST) && array_key_exists('password', $_POST)) {
    $identifiers = array("jean" => "gionnot", "star" => "man");
    $success = false;
    if (array_key_exists($_POST['login'], $identifiers)) {
      if ($identifiers[$_POST['login']] == $_POST['password']) {
        $success = true;
      }
    }

    if ($success) {
      $_SESSION['login'] = $_POST['login'];
      
      header('Location: http://www-etu-info.iut2.upmf-grenoble.fr/~grosa/ProgWeb/Php-tp/MVCBlog/?controller=pages&action=home');
    }
    else {
      $connexion_failed = true;
    }
  }
  else {
    $connexion_failed = false;
  }
  require_once('views/connexion.php');
}


?>
