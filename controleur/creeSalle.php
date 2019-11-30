  <?php

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
      $racine = "..";


  include "$racine/modele/bd.sallesInfo.inc.php";

  $salles = getSalle();
  $typePc = getTypePc();

  $checkCreatePoste = false;

  $titre = "Cree un poste";
  include "$racine/vue/entete.html.php";


  if(isset($_POST["namePost"]) && isset($_POST["salleVal"]) && isset($_POST["typePost"])){

    $namePost = htmlentities($_POST["namePost"]);
    $salleVal = htmlentities($_POST["salleVal"]);
    $typePost = htmlentities($_POST["typePost"]);
    $idUser = $user['id'];

    $checkCreatePoste = creePost($namePost, $salleVal, $typePost, $idUser);

  }

  include "$racine/vue/vueCreeSalle.php";
  include "$racine/vue/pied.html.php";
