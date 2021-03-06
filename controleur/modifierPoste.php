
  <?php

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
      $racine = "..";
  }

  include "$racine/modele/bd.sallesInfo.inc.php";

  $titre = "Modifier poste";

  if (isLoggedOnAsRole(2) || isLoggedOnAsRole(1)) {

    $salles = getSalle();
    $posts  = getPoste();
    $typePc = getTypePc();
    $postSelected = array();

    $requestUpdate = false;

    if (
      isset($_POST["namePostChange"]) || isset($_POST["postsVal"])
      || isset($_POST["changeSalleVal"]) || isset($_POST["typePost"])
    ) {

      $checkNameChange  = (strlen($_POST["namePostChange"]) >= 2) ? true : false;
      $postsVal         = htmlentities($_POST["postsVal"]);
      $changeSalleVal   = htmlentities($_POST["changeSalleVal"]);
      $namePostChange   = htmlentities($_POST["namePostChange"]);
      $typePost         = htmlentities($_POST["typePost"]);

      $requestUpdate = updatePosts($postsVal, $changeSalleVal, $namePostChange, $typePost, $checkNameChange);
    }
  }

  if(isset($_POST['postsValForChangeData'])){

    $postSelected = getPostWithId(htmlentities($_POST['postsValForChangeData']));
    include "$racine/vue/entete.html.php";

    if (isLoggedOnAsRole(2) || isLoggedOnAsRole(1)) {
      include "$racine/vue/vueModifierPoste.php";
    }else{
      include "$racine/vue/vueErrorPage.php";
    }
    include "$racine/vue/pied.html.php";
  }else {
    include "$racine/vue/entete.html.php";

      if (isLoggedOnAsRole(2) || isLoggedOnAsRole(1)) 
        include "$racine/vue/vueModifierPoste.php";
      else
        include "$racine/vue/vueErrorPage.php";
      
    include "$racine/vue/pied.html.php";
  }
