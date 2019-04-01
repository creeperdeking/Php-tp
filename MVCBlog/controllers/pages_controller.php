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

function write() {
  //////////////// A COMPLETER ////////////////
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
        default:
            error();
            break;
    }
    return true;
}

?>
