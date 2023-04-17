<?php

/*
 * TableToTableWithFetchAllController.php
 */

$tableName = filter_input(INPUT_GET, "tableName");
$lines = array();
$firstLine = array();
if ($tableName != null) {
    try {
        // Connexion à la base de données (comme d'habitude)
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        // Exécution de la requête
        // on sélectionne toute la table (cette fois)
        $cursor = $pdo->query("SELECT * FROM $tableName");
        $cursor->setFetchMode(PDO::FETCH_ASSOC);
        
        // Chargement de toutes les données
        // Tableau ordinal de tableaux ordinaux (on sélectionne toutes les lignes avec fetchAll())
        $lines = $cursor->fetchAll();
        // La première ligne (on sélectionne la première ligne), on ajoute donc [0]
        $firstLine = $lines[0];
        // Fermeture du curseur
        $cursor->closeCursor();
    } catch (PDOException $exc) {
        echo $exc->getTraceAsString();
    }
}


include './TableToTableWithFetchAllView.php';
?>
