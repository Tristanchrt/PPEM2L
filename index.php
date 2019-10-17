  <?php
  include "getRacine.php";
  include "$racine/controleur/controleurPrincipal.php";

  $action = (isset($_GET["action"])) ? $_GET["action"] : $action = (!isset($_SESSION)) ? "connexion" : "defaut";



  $fichier = controleurPrincipal($action);
  include "$racine/controleur/$fichier";



  ?>
