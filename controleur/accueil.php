	<?php

	if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
	    $racine = "..";


	include_once "$racine/modele/bd.sallesInfo.inc.php";

	$titre = "Accueil";

	if(isLoggedOnAsRole(2) || isLoggedOnAsRole(1) || isLoggedOnAsRole(0) ){

		$salle = getSalle();
		$typePc = getTypePc();

		for ($i = 0; $i < count($salle); $i++)
			$postSalle[$i] = getPosteSalle($salle[$i]->nSalle);

		if (isset($_GET['nSalle'])) {

			for ($i = 0; $i < count($salle); $i++) {
				if ($salle[$i]->nSalle == htmlentities($_GET['nSalle'])) {
					$nomSalle = $salle[$i]->nomSalle;
					$numSalle = $salle[$i]->nSalle;
				}
			}



			$titre = "Detail de la salle";
			$postSalleBySalle = getPosteSalle($numSalle);

			include "$racine/vue/entete.html.php";
			include "$racine/vue/vueDetaills.php";
			include "$racine/vue/pied.html.php";
		} else {

			include "$racine/vue/entete.html.php";
			include "$racine/vue/vueAccueil.php";
			include "$racine/vue/pied.html.php";
		}
	}else{
		$titre = "Erreur de chargement";
		include "$racine/vue/entete.html.php";
		include "$racine/vue/vueErrorPage.php";
		include "$racine/vue/pied.html.php";
	}

	


