  <?php
  include "getRacine.php";
  include "$racine/controleur/controleurPrincipal.php";

  $action = (isset($_GET["action"])) ? $_GET["action"] : "defaut";

  $fichier = controleurPrincipal($action);
  include "$racine/controleur/$fichier";



  ?>
