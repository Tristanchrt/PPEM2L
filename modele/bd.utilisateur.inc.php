<?php

include_once "bd.inc.php";

function getUtilisateurByName($nameU) {

    try {
        $cnx = connexionPDOMRBS();
        $req = $cnx->prepare("select * from mrbs_users where name=:name");
        $req->bindValue(':name', $nameU, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function addUtilisateur($mailU, $mdpU, $pseudoU) {
    try {

        $cnx = connexionPDOMRBS();
        $mdpUCrypt = crypt($mdpU, "sel");
        $req = $cnx->prepare("insert into mrbs_users (name, password, email) values(:pseudoU,:mdpU,:mailU)");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':mdpU', $mdpUCrypt, PDO::PARAM_STR);
        $req->bindValue(':pseudoU', $pseudoU, PDO::PARAM_STR);

        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}



?>
