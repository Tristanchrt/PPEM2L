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
    $salleSecleted ='s01';
    $dateSecleted = date("Y-m-d");
    
    
    if(!empty($_POST['setPlanningTitle']) && !empty($_POST['setPlanningDate']) && !empty($_POST['setPlanningSalle'])){

        $user = getUtilisateurByName($_SESSION["name"]);
        $checkPlanning = updatePlanning($_POST['setPlanningTitle'], $_POST['setPlanningHour'], $_POST['setPlanningDate'], $_POST['setPlanningSalle'], $user);
    }

    if(isset($_POST['dateSearchPlan']) && isset($_POST['changeSfdalleVal'])) {
        $salleSecleted = $_POST['changeSfdalleVal'];
        $dateSecleted = $_POST['dateSearchPlan'];
    }
    
    $firstMondayThisWeek= new DateTime($dateSecleted);
    $firstMondayThisWeek->modify('tomorrow');
    $firstMondayThisWeek->modify('last Monday');

    $nextFiveWeekDays = new DatePeriod($firstMondayThisWeek, DateInterval::createFromDateString('+1 weekdays'), 4);

    $arrayDateWeek = getAllDateInWeek(iterator_to_array($nextFiveWeekDays));
    $firstDayWeek = $arrayDateWeek[0];
    $lastDayWeek = $arrayDateWeek[4];

    $dayHorraire['Monday'] = [];
    $dayHorraire['Tuesday'] = []; 
    $dayHorraire['Wednesday'] = []; 
    $dayHorraire['Thursday'] = []; 
    $dayHorraire['Friday'] = []; 

    $weekHorraire = getWeekHorraire($salleSecleted, $firstDayWeek, $lastDayWeek);

    foreach($weekHorraire as $keyHorraire => $horraire){
        $day = date('l', strtotime($horraire->dateSelected));
        $array[$horraire->heureid] = $horraire->title;
        $dayHorraire[$day][$horraire->heureid] = $horraire->title."<br>Par : ".$horraire->userReserved;
        $array = [];
    }
    

    include "$racine/vue/entete.html.php";
    include "$racine/vue/vuePlanning.php";
    include "$racine/vue/pied.html.php";
} else {
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueErrorPage.php";
    include "$racine/vue/pied.html.php";
}
