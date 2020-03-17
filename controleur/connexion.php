  <?php

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
      $racine = "..";
  }

  include "$racine/modele/bd.connexion.php";


  // recuperation des donnees GET, POST, et SESSION
  if (isset($_POST["mailU"]) && isset($_POST["mdpU"])){
      $mailU = htmlentities($_POST["mailU"]);
      $mdpU  = htmlentities($_POST["mdpU"]);
  }
  else {
      $mailU = "";
      $mdpU = "";
  }

  login($mailU,$mdpU);

  if (isLoggedOn()){
      header('Location: ./?action=accueil');
  }
  else {
      $titre = "Connexion";
      include "$racine/vue/entete.html.php";
      include "$racine/vue/vueConnexion.php";
      include "$racine/vue/pied.html.php";
  }
