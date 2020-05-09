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

    function getPosteBySalle() {
        $resultat = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT COUNT(*) as nbPosteSalle, nomSalle FROM `poste` INNER JOIN salle ON poste.nSalle = salle.nSalle GROUP BY poste.nSalle");

            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_ASSOC);
            while ($ligne) {
                $resultat[] = $ligne;
                $ligne = $req->fetch(PDO::FETCH_ASSOC);
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
            $req->bindValue(':nSalle', $nSalle, PDO::PARAM_STR);
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

    function creePost($namePost, $salleVal, $typePost, $idUser, $allLog){

      try {
            $cnx = connexionPDO();
            
            $idUser = 1;
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


            if($allLog != 1)
                updateLogInPost($allLog, $totPost);

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

    function getLogiciel() {
        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM logiciel");

            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_ASSOC);
            while ($ligne) {
                $resultat[] = $ligne;
                $ligne = $req->fetch(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    function getLogicielByPost($nPoste) {
        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM installer WHERE nPoste = :nPoste");
            $req->bindValue(':nPoste', $nPoste, PDO::PARAM_STR);
            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_ASSOC);
            if($ligne == null)
                return 1;
                
            while ($ligne) {
                $resultat[] = $ligne;
                $ligne = $req->fetch(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    function updateLogInPost($logInPost, $postId) {
        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("DELETE FROM installer WHERE nPoste = :nPoste");
            $req->bindValue(':nPoste', $postId, PDO::PARAM_STR);
            $resultat = $req->execute();

            foreach($logInPost as $key => $log){
                $req = $cnx->prepare("INSERT INTO installer (nPoste, nLog, dateIns) VALUES (:nPoste, :logPoste, NOW())");
                $req->bindValue(':nPoste', $postId, PDO::PARAM_STR);
                $req->bindValue(':logPoste', $log, PDO::PARAM_STR);
                $resultat = $req->execute();
            }

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    
    function getHorraire() {
        $resultat = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT * FROM horraire");

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
    function getWeekHorraire($salle, $firsDay, $lasDay) {
        $resultat = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT heureid, dateSelected, title, name as userReserved FROM planningreserved 
                                INNER JOIN mrbs_users ON mrbs_users.id = planningreserved.userReserved WHERE idSalle = :nSalle AND dateSelected 
                                BETWEEN :fDay AND :lDay ORDER BY dateSelected, heureid ASC");
            $req->bindValue(':nSalle', $salle, PDO::PARAM_STR);
            $req->bindValue(':fDay', $firsDay, PDO::PARAM_STR);
            $req->bindValue(':lDay', $lasDay, PDO::PARAM_STR);
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
    function updatePlanning($titlePlannig, $hour, $date, $salle, $user) {
        $resultat = array();
        try {
            $date = date("Y-m-d H:i:s", strtotime($date));
            $checkPlan = checkPlanning($hour, $date, $salle);
            if(intval($checkPlan['checkPlan']) > 0){
                return 1;
            }

            $cnx = connexionPDO();
            $req = $cnx->prepare("INSERT INTO planningreserved (dateSelected, heureid, userReserved, title, idSalle) 
                                    VALUES (:dateSelected, :heureid, :userReserved, :title, :idSalle)");

            $req->bindValue(':dateSelected', $date, PDO::PARAM_STR);
            $req->bindValue(':heureid', $hour, PDO::PARAM_INT);
            $req->bindValue(':userReserved', $user['id'], PDO::PARAM_INT);
            $req->bindValue(':title', $titlePlannig, PDO::PARAM_STR);
            $req->bindValue(':idSalle', $salle, PDO::PARAM_STR);
            $req->execute();
            $resultat = $req;

        } catch (\Exception $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
    function checkPlanning($hour, $datee, $salle) {
        $ligne = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT COUNT(*) as checkPlan FROM planningreserved WHERE heureid = :hour AND dateSelected = :datee AND idSalle = :salle ");
            $req->bindValue(':hour', $hour, PDO::PARAM_STR);
            $req->bindValue(':datee', $datee, PDO::PARAM_STR);
            $req->bindValue(':salle', $salle, PDO::PARAM_STR);
            $req->execute();
            
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
          
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $ligne;
    }
    function deltePlanningAdmin($dates, $houre, $salle) {
        $ligne = array();

        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("DELETE FROM `planningreserved` WHERE dateSelected = :dates AND heureid = :houre AND idSalle = :salle");
            $req->bindValue(':dates', $dates, PDO::PARAM_STR);
            $req->bindValue(':houre', $houre, PDO::PARAM_STR);
            $req->bindValue(':salle', $salle, PDO::PARAM_STR);
            $req->execute();
            $req->execute();
            $resultat = $req;

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $ligne;
    }
    function getAllDateInWeek($week){
        foreach($week[0] as $key => $f){
            $firstDayWeek = $f;
            break;
        }
        foreach($week[1] as $key => $f){
            $deuDayWeek = $f;
            break;
        }
        foreach($week[2] as $key => $f){
            $treeDayWeek = $f;
            break;
        }
        foreach($week[3] as $key => $f){
            $thirdDayWeek = $f;
            break;
        }
        foreach($week[4] as $key => $f){
            $lastDayWeek = $f;
            break;
        }
        return [$firstDayWeek, $deuDayWeek, $treeDayWeek, $thirdDayWeek, $lastDayWeek];
    }





    ?>
