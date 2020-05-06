  <?php

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
      $racine = "..";


  include "$racine/modele/bd.sallesInfo.inc.php";
  
  $titre = "Création de poste";

  if(isLoggedOnAsRole(2)){
    $salles = getSalle();
    $typePc = getTypePc();
    $logiciels = getLogiciel();

    $checkCreatePoste = false;

    if (isset($_POST["namePost"]) && isset($_POST["salleVal"]) && isset($_POST["typePost"])) {

      $namePost = htmlentities($_POST["namePost"]);
      $salleVal = htmlentities($_POST["salleVal"]);
      $typePost = htmlentities($_POST["typePost"]);
      $idUser = 1;

      $allLog = (empty($_POST['arrayLog'])) ? 1 : $_POST['arrayLog'];
      $checkCreatePoste = creePost($namePost, $salleVal, $typePost, $idUser, $allLog);
      
    }

    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueCreePoste.php";
    include "$racine/vue/pied.html.php";

  }else{
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueErrorPage.php";
    include "$racine/vue/pied.html.php";
  }
