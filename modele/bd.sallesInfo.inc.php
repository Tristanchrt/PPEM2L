    <?php

    include "bd.connexion.php";

    function getSalle() {
        $resultat = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM salle");

            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_OBJ);
            while ($ligne) {
                $resultat[] = $ligne;
                $ligne = $req->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function getPosteSalle($nSalle) {
        $resultat = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM poste WHERE nSalle=:nSalle");
            $req->bindValue(':nSalle', $nSalle, PDO::PARAM_INT);
            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_OBJ);
            while ($ligne) {
                $resultat[] = $ligne;
                $ligne = $req->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    function getPoste() {
        $resultat = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM poste");
            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_OBJ);
            while ($ligne) {
                $resultat[] = $ligne;
                $ligne = $req->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function getTypePc() {
        $resultat = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM types");
            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_OBJ);
            while ($ligne) {
                $resultat[] = $ligne;
                $ligne = $req->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function creePost($namePost, $salleVal, $typePost, $idUser){

      try {

            $cnx = connexionPDO();

            $namePostt = getIpSalle($salleVal);
            $ipSalle = $namePostt['indIP'];

            $totPost = getIdPost();
            $totPost = "p".intval($totPost['COUNT(nPoste)']+1);

            $req = $cnx->prepare("insert into poste (nPoste, nomPoste, indIP, ad, typePoste , nSalle)
                values(:totPost,:namePost,:ipSalle,:idUser,:typePost,:salleVal)");

            $req->bindValue(':totPost', $totPost, PDO::PARAM_STR);
            $req->bindValue(':namePost', $namePost, PDO::PARAM_STR);
            $req->bindValue(':ipSalle', $ipSalle, PDO::PARAM_STR);
            $req->bindValue(':idUser', $idUser, PDO::PARAM_INT);
            $req->bindValue(':typePost', $typePost, PDO::PARAM_STR);
            $req->bindValue(':salleVal', $salleVal, PDO::PARAM_STR);

            $resultat = $req->execute();

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function getIpSalle($nameSalle){

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM salle WHERE nSalle =:nameSalle");
            $req->bindValue(':nameSalle', $nameSalle, PDO::PARAM_STR);
            $req->execute();

            $req = $req->fetch(PDO::FETCH_ASSOC);
            $resultat = $req;

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;

    }

    function getIdPost(){

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT COUNT(nPoste) FROM poste");
            $req->execute();

            $resultat = $req->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;

    }

    function updatePosts($postsVal, $changeSalleVal, $namePostChange, $typePost, $checkNameChange){

      $namePostt = getIpSalle($changeSalleVal);
      $ipSalle = $namePostt['indIP'];

      try {
          $cnx = connexionPDO();
          if($checkNameChange)
            $updateRequest = sprintf("UPDATE poste SET nomPoste = '%s' ,indIP = '%s', typePoste = '%s', nSalle = '%s' WHERE nPoste = '%s'",
                              $namePostChange, $ipSalle, $typePost, $changeSalleVal, $postsVal);
          else
            $updateRequest = sprintf("UPDATE poste SET indIP = '%s' ,typePoste = '%s', nSalle = '%s' WHERE nPoste = '%s'",
                             $ipSalle, $typePost, $changeSalleVal, $postsVal);

          $req = $cnx->prepare($updateRequest);
          $req->execute();
          $resultat = $req;

      } catch (PDOException $e) {
          print "Erreur !: " . $e->getMessage();
          die();
      }
      return $resultat;

    }
    function getPostWithId($nPoste) {
        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM poste WHERE nPoste =:nPoste");
            $req->bindValue(':nPoste', $nPoste, PDO::PARAM_STR);
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }




    ?>
