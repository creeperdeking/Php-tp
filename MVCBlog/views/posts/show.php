<p>Voici le post (billet) demandé :</p>

<p><b><?= $post->get('author') ?></b></p>
<p><b><?= $post->get('title') ?></b></p>
<p><i><?= $post->get('content') ?></i></p>
<?php
if ($_SESSION['login'] === $post->get('author')) {
  echo "<a href='?controller=posts&action=ask_delete&id=" . $post->get('id') . "'>Delete</a>";
}
?>
