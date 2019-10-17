  <?php

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
      $racine = "..";
  }

  include_once "$racine/modele/bd.utilisateur.inc.php";

  $inscrit = false;
  $msg="";
  // recuperation des donnees GET, POST, et SESSION
  if (isset($_POST["mailU"]) && isset($_POST["mdpU"]) && isset($_POST["pseudoU"])) {

      if ($_POST["mailU"] != "" && $_POST["mdpU"] != "" && $_POST["pseudoU"] != "") {
          $mailU = $_POST["mailU"];
          $mdpU = $_POST["mdpU"];
          $pseudoU = $_POST["pseudoU"];

          // enregistrement des donnees
          $ret = addUtilisateur($mailU, $mdpU, $pseudoU);
          if ($ret) {
              $inscrit = true;
          } else {
              $msg = "l'utilisateur n'a pas été enregistré.";
          }
      }
   else {
      $msg="Renseigner tous les champs...";
      }
  }

  if ($inscrit) {
      header('Location: ./?action=connexion');
  } else {

      $titre = "Inscription pb";
      include "$racine/vue/entete.html.php";
      include "$racine/vue/vueInscription.php";
      include "$racine/vue/pied.html.php";
  }
