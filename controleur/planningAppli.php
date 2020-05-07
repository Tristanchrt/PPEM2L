<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
    $racine = "..";


include "$racine/modele/bd.sallesInfo.inc.php";

$titre = "Planning reservation salles";

if (isLoggedOnAsRole(2) || isLoggedOnAsRole(1) || isLoggedOnAsRole(0)) {

    $postes  = getPoste();
    $logicels = getLogiciel();
    $salles = getSalle();
    $nbPostesSalles = getPosteBySalle();
    $horraires = getHorraire();

    include "$racine/vue/entete.html.php";
    include "$racine/vue/vuePlanning.php";
    include "$racine/vue/pied.html.php";
} else {
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueErrorPage.php";
    include "$racine/vue/pied.html.php";
}
