<?php
require_once('models/connection.php');
session_start();

// Un post d'un blog
class Post {

  // Un post a trois attributs
  // ils sont déclarés publiques pour éviter la lourdeur des accesseurs&mutateurs
  //  (et pouvoir utiliser $post->author directement)
  // C'est bien sûr à éviter dans un vrai projet
  private $author;
  private $content;
  private $id; //éventuellement NULL si pas encore d’id attribué


  // Creation d'un post
  public function __construct(string $author, string $content, $id=NULL) {
    $this->set('author', $author);
    $this->set('content', $content);
    $this->set('id', $id);
  }

  // Retourne tous les posts dans un vecteur
  public static function all(): array {
    $db = Db::getInstance();
    $req = $db->query('SELECT * FROM posts');
    // On créé le tableau des posts directement via fetchclass
    return $req->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post', array('author', 'content', 'id'));
  }

  public function get(string $var_name) {
    switch ($var_name) {
      case 'author':
        return $this->author;
        break;
      case 'content':
        return $this->content;
        break;
      case 'id':
        return $this->id;
        break;
      default:
        break;
    }
  }

  //On évite les injections SQL grâce aux setter magique sécurisé
  public function set(string $var_name, $value) {
    switch ($var_name) {
      case 'author':
        $this->author = pg_escape_string($value);
        break;
      case 'content':
        $this->content = pg_escape_string($value);
        break;
      case 'id':
        $this->id = intval($value);
        break;
      default:
        break;
    }
  }

  // Retourne un post connaissant son id
  public static function find(int $id): Post {
    $db = Db::getInstance();
    // On vérifie que $id est bien un entier
    $req = $db->prepare('SELECT author, content, id FROM posts WHERE id = :id');
    // La requête ayant été préparée, on remplace :id avec la valeur de $id
    $req->bindParam(':id', $id);
    $req->execute();
    $var_ret = $req->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post', array('author', 'content', 'id'));
    return $var_ret[0];
  }

  // Enregistre le post dans la base, et renvoie vrai si l'écriture a réussi
  public function write(): bool {
    if (!isset($this->id)) {
      return FALSE;
    }
    $condition_ok = FALSE;
    if (array_key_exists('last_writen_post', $_SESSION)) {
      $condition_ok = $_SESSION['last_writen_post']->get('author') !== $this->get('author') || $_SESSION['last_writen_post']->get('content') !== $this->get('content');
    }
    else {
        $condition_ok = TRUE;
    }

    $success = TRUE;
    if ($condition_ok) {
      $db = Db::getInstance();

      $req = $db->prepare('INSERT INTO posts VALUES (:id, :author, :content)');
      $req->bindParam(':id', $this->id);
      $req->bindParam(':author', $this->author);
      $req->bindParam(':content', $this->content);
      $success = $req->execute();
      $_SESSION['last_writen_post'] = clone $this;
    }
    else {
      $success = False;
    }
    return $success;
  }

  // Enregistre le post dans la base, et renvoie vrai si l'écriture a réussi
  public static function delete($id): bool {
    $db = Db::getInstance();

    //On évite les injections SQL:
    $id = intval($id);

    $req = $db->prepare('delete FROM posts WHERE id=:id');
    $req->bindParam(':id', $id);
    // On transforme notre classe en tableau et on le passe en paramètre à execute
    $success = $req->execute();
    return $success;
  }

}

?>
