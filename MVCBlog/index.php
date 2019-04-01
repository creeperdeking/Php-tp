<?php

//Page principale
require_once('models/connection.php');

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
?>