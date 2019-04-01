<p>Voici le post (billet) demandé :</p>

<p><b><?= $post->get('author') ?></b></p>
<p><i><?= $post->get('content') ?></i></p>
<a href='?controller=posts&action=delete&id=<?= $_GET['id'] ?>'>Delete</a>
