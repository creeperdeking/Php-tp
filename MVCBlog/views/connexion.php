<p>Saisissez vos identifiant s'il vous plait :</p>
<?php
if ($connexion_failed) {
  echo "La connexion a échoué, veuillez rééssayer";
}
?>

<form action="index.php" method="POST">
  <fieldset>
    Identifiant : <input type="texte" name="login"><br />
    Mot de passe : <input type="password" name="password">
    <input type="submit" value="Enregistrer">
  </fieldset>
</form>
