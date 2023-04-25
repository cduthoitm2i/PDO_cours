<?php

/*
 * AuthentificationCTRL
 */
$message = "";

$btValider = filter_input(INPUT_POST, "btValider");

if ($btValider != null) {
    $pseudo = filter_input(INPUT_POST, "pseudo");
    $mdp = filter_input(INPUT_POST, "mdp");
    // On test si les deux champs ne sont pas vide, sinon on mettrait un required dans la balise input
    if ($pseudo == null || $mdp == null) {
        setcookie("pseudo", "");
        setcookie("mdp", "");
        $message = "Toutes les saisies sont obligatoires";
    } else {
        $message = "Jusque là tout va bien !!!";
        // On test si le bouton "Se souvenir de moi est coché", on reprend la valeur chkSeSouvenir de la balise input
        $chkSeSouvenir = filter_input(INPUT_POST, "chkSeSouvenir");
        // On test si c'est coché
        if ($chkSeSouvenir != null) {
            $message = "Coché !!!";
            // On affecte les cookies pour les deux variables (3600 secondes, 24 heures, 7 jours, soit expire dans 7 jours)
            setcookie("pseudo", $pseudo, time() + (3600 * 24 * 7));
            setcookie("mdp", $mdp, time() + (3600 * 24 * 7));
        } else {
            $message = "Pas Coché !!!";
            setcookie("pseudo", "", 0);
            setcookie("mdp", "", 0);
            $pseudo = "";
            $mdp = "";
        }
    }
} else {
    $message = "First time !!!";
}

$pseudoCook = filter_input(INPUT_COOKIE, "pseudo");
$mdpCook = filter_input(INPUT_COOKIE, "mdp");
if ($pseudoCook != null && $mdpCook != null) {
    $pseudo = $pseudoCook;
    $mdp = $mdpCook;
}

include '../AuthentificationView.php';
?>
