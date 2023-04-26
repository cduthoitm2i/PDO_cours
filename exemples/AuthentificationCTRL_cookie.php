<?php

// AuthentificationCTRL.php

header("Content-Type: text/html; charset=UTF-8");

$message = "";

$pseudo = filter_input(INPUT_POST, "pseudo");
$mdp = filter_input(INPUT_POST, "mdp");
$btReinitialiser = filter_input(INPUT_POST, "btReinitialiser");

if ($pseudo != null && $mdp != null) {
    try {
        /*
         * Connexion
         */
        $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        // Le SELECT
        $select = "SELECT * FROM utilisateurs WHERE pseudo=? AND mdp=?";
        // Compilation du SELECT
        $curseur = $pdo->prepare($select);
        // Valorisation des paramètres
        $curseur->bindParam(1, $pseudo);
        $curseur->bindParam(2, $mdp);
        // Exécution du SELECT (uniquement si déclaration avant $curseur)
        $curseur->execute();
        // Récupération ou pas d'un enregistrement
        // http://php.net/manual/fr/pdostatement.fetch.php
        $enregistrement = $curseur->fetch();
        if ($enregistrement === FALSE) {
            $message = "KO, vous n'êtes pas connecté(e)";
        } else {
            $message = "0K, vous êtes connecté(e)";
            // Ajout Cookie pour pseudo
            setCookie("pseudo", $pseudo, 0, null, null, false, false);
            setCookie("mdp", $mdp, 0, null, null, false, false);
            // Ajout du contrôle sur le bouton Se souvenir de moi
           
            if($_POST["btReinitialiser"]) {
                setCookie("pseudo", "");
                setCookie("mdp", "");
            }
        }
        $curseur->closeCursor();
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage() . "<br>";
    }
    $pdo = null;
} else {
    $message = "Toutes les saisies sont obligatoires !!!";
}

include "AuthentificationIHM.php";
