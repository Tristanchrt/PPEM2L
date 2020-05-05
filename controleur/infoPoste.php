<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
    $racine = "..";


include "$racine/modele/bd.sallesInfo.inc.php";

$titre = "Information sur les postes";

if (isLoggedOnAsRole(2) || isLoggedOnAsRole(1) || isLoggedOnAsRole(0)) {

    $salles = getSalle();
    $posts  = getPoste();
    $typePc = getTypePc();
  
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueInfoPoste.php";
    include "$racine/vue/pied.html.php";
} else {
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueErrorPage.php";
    include "$racine/vue/pied.html.php";
}
