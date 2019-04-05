<?php

//contrôleurs pour les pages statiques

function home() {
    //valeurs en dur pour les tests :
    $first_name = 'Jon';
    $last_name = 'Snow';
    require_once('views/pages/home.php');
}

function error() {
    require_once('views/pages/error.php');
}

function deconnexion() {
  unset($_SESSION['login']);
  session_destroy();
  require_once('views/pages/deconnexion.php');
}

function actor($action) : bool {
    switch ($action) {
        case 'home':
            home();
            break;
        case 'write':
            write();
            break;
        case 'error':
            error();
            break;
        case 'deconnexion':
            deconnexion();
            break;
        default:
            error();
            break;
    }
    return true;
}

?>
