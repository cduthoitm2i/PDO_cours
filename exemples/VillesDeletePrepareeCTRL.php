<?php

// --- SQL parametre : VillesDeletePrepareeCTRL.php
header("Content-Type: text/html; charset=UTF-8");
$message = "";
$btSup = filter_input(INPUT_POST, "btSup");
$cp = filter_input(INPUT_POST, "cp");
if ($btSup != null) {
    // On filtre sur la colonne cp (récupération de toutes les valeurs)
    if ($cp != null) {
        try {
            /*
             * Connexion
             */
            $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET NAMES 'UTF8'");
            /*
             * INSERTION
             */
            // requête SQL
            // On supprime donc à l'aide de cet syntaxe
            $sql = "DELETE FROM villes WHERE cp = ?";

            $statement = $pdo->prepare($sql);
            // paramètre PDO::PARAM_STR pas obligatoire
            $statement->bindParam(1, $cp, PDO::PARAM_STR);
            $statement->execute();
            // Retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute() 
            // Dans notre cas, ce sera toujours 1 puisque l'on ajoute une seule nouvelle entrée
            $message .= $statement->rowcount() . " enregistrement(s) supprimé(s)<br>";



            $pdo = null;
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
    } else {
        $message = "Toutes les saisies sont obligatoires";
    }
}
include './VillesDeletePrepareeIHM.php';
?>