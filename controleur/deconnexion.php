

  <?php

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
      $racine = "..";


  include_once "$racine/modele/bd.connexion.php";

  logout();
  header('Location: ./?action=connexion');
