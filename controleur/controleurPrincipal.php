<?php

function controleurPrincipal($action) {

    $lesActions = array();
    $lesActions["defaut"] = "accueil.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["inscription"] = "inscription.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["profil"] = "profil.php";
    $lesActions["creerPoste"] = "creePoste.php";
    $lesActions["modifierPoste"] = "modifierPoste.php";

    if (array_key_exists($action, $lesActions)) {
      $action = (isset($_GET["action"])) ? $_GET["action"] : $action = (!isset($_SESSION["name"])) ? "connexion" : "defaut";
      // $action = (isset($_SESSION["name"])) ? "connexion" : $action = (isset($_GET["action"])) ? $_GET["action"] : "defaut";
      return $lesActions[$action];
    }
    else {
        return $lesActions["defaut"];
    }
}

?>
