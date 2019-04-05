<p>Voici la liste de tous les posts (seul l’auteur s’affiche, cliquez pour lire le contenu) :</p>

<a href="views/posts/write.php">Saisie</a>

<?php

foreach ($posts as $post) {
    echo "<p>";
    echo "<a href='?controller=posts&action=show&id=" . $post->get('id') . "'>" . $post->get('title') . "</a>";

    if ($_SESSION['login'] === $post->get('author')) {
      echo "<a href='?controller=posts&action=ask_delete&id=" . $post->get('id') . "'>Delete</a>";
    }
    echo "</p>";
}
?>
