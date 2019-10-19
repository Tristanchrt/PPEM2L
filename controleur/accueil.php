	<?php

	if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
	    $racine = "..";


	include_once "$racine/modele/bd.sallesInfo.inc.php";

	$salle = getSalle();

	for ($i = 0; $i < count($salle); $i++)
		$postSalle[$i] = getPosteSalle($salle[$i]->nSalle);

	if(isset($_GET['nSalle'])){

		$titre = "Detail de la salle";
		$numSalle = htmlentities($_GET['nSalle']);
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
