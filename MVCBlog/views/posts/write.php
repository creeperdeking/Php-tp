<p>Veuillez saisir un nouveau post :</p>
<form action="../../index.php" method="GET">
  <fieldset>
    <input type="hidden" name="author" value=<?php session_start(); echo $_SESSION['login']; ?>>
    Titre : <input type="texte" name="title">
    Contenu : <input type="texte" name="content">
    <input type="hidden" name="action" value="write">
    <input type="hidden" name="controller" value="posts">
    <input type="submit" value="Enregistrer">
  </fieldset>
</form>
