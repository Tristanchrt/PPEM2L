  <?php

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
      $racine = "..";
  }

  include "$racine/modele/bd.sallesInfo.inc.php";

  $salles = getSalle();
  $posts = getPoste();
  $typePc = getTypePc();

  $requestUpdate = false;

  if(isset($_POST["namePostChange"]) || isset($_POST["postsVal"]) || isset($_POST["changeSalleVal"]) || isset($_POST["typePost"])) {

    $checkNameChange = (strlen($_POST["namePostChange"]) >= 2) ? true : false;
    $postsVal = htmlentities($_POST["postsVal"]);
    $changeSalleVal = htmlentities($_POST["changeSalleVal"]);
    $namePostChange = htmlentities($_POST["namePostChange"]);
    $typePost = htmlentities($_POST["typePost"]);

    $requestUpdate = updatePosts($postsVal, $changeSalleVal, $namePostChange, $typePost, $checkNameChange);

  }

  $titre = "Modifier posts";
  include "$racine/vue/entete.html.php";
  include "$racine/vue/vueModifierSalle.php";
  include "$racine/vue/pied.html.php";
