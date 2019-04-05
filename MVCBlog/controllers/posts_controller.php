<?php
// Controleurs pour les post du blog

function index() {
    // On stocke les posts dans une variable tableau
    $posts = Post::all();
    require_once('views/posts/index.php');
}

function show() {
    // On s'attend à une url de la forme ?controller=posts&action=show&id=x
    // sans id, on redirige vers la page d'erreur puisqu'on ne peut rien faire sans
    if (!isset($_GET['id'])){
        require_once('views/pages/error.php');die();}

    // on utilise l'id fourni pour obtenir le post correspondant
    $post = Post::find(intval($_GET['id']));
    require_once('views/posts/show.php');
}

function write() : bool {
    //Méthode pour enregistrer le post courant

    if (isset($_GET['author']) && isset($_GET['content']) && isset($_GET['title'])) {
        //On récupère les paramètres dans l'url...
        $author = $_GET['author'];
        $content = $_GET['content'];
        $title = $_GET['title'];

        $posts = Post::all();

        $max = 0;
        foreach ($posts as $key => $value) {
          if(intval($value->get('id')) > $max) {
            $max = intval($value->get('id'));
          }
        }

        $post = new Post($author, $title, $content, $max + 1);

        if ($post->Write()) {
          echo "Nouveau post ajouté avec succès";
          $_GET['id'] = $post->get('id');
          return true;
        }
        else {
            require_once('views/pages/error.php');die();
            return false;
        }
    }
    else {
       require_once('views/pages/error.php');die();
       return false;
    }
}

function delete(): bool {
  $success = Post::delete($_GET['id']);
  echo 'µOK';
  if ($success) {
    header('Location: http://www-etu-info.iut2.upmf-grenoble.fr/~grosa/ProgWeb/Php-tp/MVCBlog/?controller=posts&action=index');
  }
  else {
      require_once('views/pages/error.php');die();
  }
  return $success;
}

function ask_delete() {
  require_once('views/pages/confirm_delete.php');
}

function actor($action) : bool {
    switch ($action) {
        case 'index':
            index();
            break;
        case 'show':
            show();
            break;
        case 'write':
            return write();
            break;
        case 'delete':
            return delete();
            break;
        case 'ask_delete':
            ask_delete();
            break;
        default:
            //On est obligé d'appeler directement error.php, si on appel call()
            // on créé un conflit sur actor() qui est présent dans les deux
            // sous-contrôleurs inclus
            require_once('views/pages/error.php');
            break;
    }
    return True;
}

?>
