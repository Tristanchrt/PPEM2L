  <?php

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
      $racine = "..";
  }

  include_once "$racine/modele/bd.utilisateur.inc.php";

  $inscrit = false;
  $msg="";

  if (isset($_POST["mailU"]) && isset($_POST["mdpU"]) && isset($_POST["pseudoU"])) {

      if ($_POST["mailU"] != "" && $_POST["mdpU"] != "" && $_POST["pseudoU"] != "") {
          $mailU   = htmlentities($_POST["mailU"]);
          $mdpU    = htmlentities($_POST["mdpU"]);
          $pseudoU = htmlentities($_POST["pseudoU"]);

          $ret = addUtilisateur($mailU, $mdpU, $pseudoU);
          if ($ret)
              $inscrit = true;
          else
              $msg = "l'utilisateur n'a pas été enregistré.";

      }
   else {
      $msg="Renseigner tous les champs...";
      }
  }

  if ($inscrit) {
      header('Location: ./?action=connexion');
  } else {
      $titre = "Inscription";
      include "$racine/vue/entete.html.php";
      include "$racine/vue/vueInscription.php";
      include "$racine/vue/pied.html.php";
  }
