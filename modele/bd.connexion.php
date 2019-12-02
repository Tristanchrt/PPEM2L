<?php

include "bd.utilisateur.inc.php";

function login($name, $mdpU) {
    if (!isset($_SESSION)) {
        session_start();
    }

    $util = getUtilisateurByName($name);
    $mdpBD = $util["password"];

    if (trim($mdpBD) == trim(crypt($mdpU, $mdpBD))) {
        $_SESSION["name"] = $name;
        $_SESSION["password"] = $mdpBD;
        var_dump($_SESSION["name"]);
    }
}

function logout() {
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION["name"]);
    unset($_SESSION["password"]);
}

function getNameULoggedOn(){
    if (isLoggedOn()){
        $ret = $_SESSION["name"];
    }
    else {
        $ret = "";
    }
    return $ret;

}

function isLoggedOn() {
    if (!isset($_SESSION)) {
        session_start();
    }
    $ret = false;

    if (isset($_SESSION["name"])) {
        $util = getUtilisateurByName($_SESSION["name"]);
        if ($util["name"] == $_SESSION["name"] && $util["password"] == $_SESSION["password"]) {
            $ret = true;
        }
    }
    return $ret;
}
function InfoUtilisateur() {
    if (!isset($_SESSION)) {
        session_start();
    }

    $ret = '';

    if (isset($_SESSION["name"])) {
        $util = getUtilisateurByName($_SESSION["name"]);
        if ($util["name"] == $_SESSION["name"] && $util["password"] == $_SESSION["password"]) {
            $ret = $util;
        }
    }
    return $ret;
}

?>
