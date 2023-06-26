<?php

// AuthentificationAjax.php
// http://localhost/PDOCours/exemples/AuthentificationAjax.php?pseudo=p&mdp=b

// On ajoute les header (obligatoire dans le fichier PHP)
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");

$message = "";

// On récupère dans des variables (avec filter_input et INPUT_GET) les infos renseignées dans les champs de saisie 
$pseudo = filter_input(INPUT_GET, "pseudo");
$mdp = filter_input(INPUT_GET, "mdp");

if ($pseudo != null && $mdp != null) {
    try {
        /*
         * Connexion à la BD (si toutes les étapes précédentes sont validées)
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
        // Exécution du SELECT
        $curseur->execute();
        // Récupération ou pas d'un enregistrement
        // http://php.net/manual/fr/pdostatement.fetch.php
        $enregistrement = $curseur->fetch();
        // Boucle si infos de connexion existe dans la BD, si oui on est connecté, si non, on n'est pas connecté
        if ($enregistrement === FALSE) {
            $message = "KO, vous n'êtes pas connecté(e)";
        } else {
            $message = "OK, vous êtes connecté(e)";
        }
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage() . "<br>";
    }
    $cnx = null;
} else {
    // Message a priori pas utile car il existe déjà des messages de contrôles de saisie dans les champs dans le fichier Authentification.js !!
    $message = "Toutes les saisies sont obligatoires !!!";
}

echo $message;
?>