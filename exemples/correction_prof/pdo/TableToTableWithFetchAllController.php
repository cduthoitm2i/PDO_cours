<?php

/*
 * TableToTableWithFetchAllController.php
 */

$tableName = filter_input(INPUT_GET, "tableName");
$enregistrements = array();
if ($tableName != null) {
    try {
        // Connexion
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        // Exécution de la requête
        $curseur = $pdo->query("SELECT * FROM $tableName");
        // Chargement de toutes les données
        // Tableau ordinal de tableaux ordinaux
        $enregistrements = $curseur->fetchAll(PDO::FETCH_NUM);
        // Fermeture du curseur
        $curseur->closeCursor();
    } catch (PDOException $exc) {
        echo $exc->getTraceAsString();
    }
}


include './TableToTableWithFetchAllView.php';
?>
