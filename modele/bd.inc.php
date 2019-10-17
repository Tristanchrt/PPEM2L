  <?php

  function connexionPDO() {
      $login = "root";
      $mdp = "root";
      $bd = "bdtest";
      $serveur = "localhost";

      try {
          $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $conn;
      } catch (PDOException $e) {
          print "Erreur de connexion PDO ";
          die();
      }
  }
  function connexionPDOMRBS() {
      $login = "root";
      $mdp = "root";
      $bd = "mrbss";
      $serveur = "localhost";

      try {
          $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $conn;
      } catch (PDOException $e) {
          print "Erreur de connexion PDO ";
          die();
      }
  }

  if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
      // prog de test
      header('Content-Type:text/plain');

      echo "connexionPDO() : \n";
      print_r(connexionPDO());

      echo "connexionPDOMRBS() : \n";
      print_r(connexionPDOMRBS());
  }

?>
