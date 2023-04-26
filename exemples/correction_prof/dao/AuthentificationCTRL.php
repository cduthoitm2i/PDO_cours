<?php

/*
 * AuthentificationCTRL
 */
$message = "";
$pseudo = "";
$mdp = "";

$btValider = filter_input(INPUT_POST, "btValider");

if ($btValider != null) {
    // 
    $pseudo = filter_input(INPUT_POST, "pseudo");
    $mdp = filter_input(INPUT_POST, "mdp");
    // 
    if ($pseudo == null || $mdp == null) {
        setcookie("pseudo", "");
        setcookie("mdp", "");
        $message = "Toutes les saisies sont obligatoires";
    } else {
        // 
        $message = "Jusque là tout va bien !!!";
        require_once '../daos/ConnectionDB.php';
        $pdo = getConnection("../conf/cours.ini");
        //
        require_once '../daos/UtilisateursDAOProcedural.php';
        $count = selectOneByPseudoAndMdp($pdo, $pseudo, $mdp);
        if ($count == 1) {
            //
            $message = "Authentification réussie !!!";
            //
            $chkSeSouvenir = filter_input(INPUT_POST, "chkSeSouvenir");
            //
            if ($chkSeSouvenir != null) {
                $message .= "<br />Coché !!!";
                setcookie("pseudo", $pseudo, time() + (3600 * 24 * 7));
                setcookie("mdp", $mdp, time() + (3600 * 24 * 7));
            } else {
                //
                $message .= "<br />Pas Coché !!!";
                setcookie("pseudo", "", 0);
                setcookie("mdp", "", 0);
                $pseudo = "";
                $mdp = "";
            }
        } else {
            //
            $message = "Authentification ratée !!!";
            setcookie("pseudo", "", 0);
            setcookie("mdp", "", 0);
            $pseudo = "";
            $mdp = "";
        }
    }
} else {
    //
    $message = "First time !!!";
    $pseudo = filter_input(INPUT_COOKIE, "pseudo");
    $mdp = filter_input(INPUT_COOKIE, "mdp");
}

include 'AuthentificationView.php';
?>
