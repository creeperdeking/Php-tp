<DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
            <header>
                <a href='?controller=pages&action=home'>Accueil</a>
                <a href='?controller=posts&action=index'>Posts</a>
                <?php
                if ($_GET['action'] == 'deconnexion') {
                  echo "<a href='?controller=pages&action=deconnexion'>Connexion</a>";
                }
                else {
                  echo "<a href='?controller=pages&action=deconnexion'>Deconnexion</a>";
                }
                ?>

            </header>

            <?php require_once('controllers/routes.php'); ?>

            <?php require_once('footer.php'); ?>

        <body>
        <html>
