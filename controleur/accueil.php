	<?php

	if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
	    $racine = "..";


	include_once "$racine/modele/bd.sallesInfo.inc.php";

	$salle = getSalle();
	$typePc = getTypePc();

	for ($i = 0; $i < count($salle); $i++)
		$postSalle[$i] = getPosteSalle($salle[$i]->nSalle);

	if(isset($_GET['nSalle'])){

		for ($i = 0; $i < count($salle); $i++){
			if($salle[$i]->nSalle == htmlentities($_GET['nSalle'])){
				$nomSalle = $salle[$i]->nomSalle;
				$numSalle = $salle[$i]->nSalle;
			}
		}

		$titre = "Detail de la salle";
		$postSalle = getPosteSalle($numSalle);
		include "$racine/vue/entete.html.php";
		include "$racine/vue/vueDetaills.php";
		include "$racine/vue/pied.html.php";

	}else {
		$titre = "Accueil";
		include "$racine/vue/entete.html.php";
		include "$racine/vue/vueAccueil.php";
		include "$racine/vue/pied.html.php";
	}
