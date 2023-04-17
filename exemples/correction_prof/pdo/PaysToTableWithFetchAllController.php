<?php

/*
 * PaysToTableWithFetchAllController
 */

try {
    // Connexion
    $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'UTF8'");

    // Exécution de la requête
    $curseur = $pdo->query("SELECT * FROM pays");
    // Chargement de toutes les données
    // Tableau ordinal de tableaux ordinaux
    $enregistrements = $curseur->fetchAll(PDO::FETCH_NUM);
    // Fermeture du curseur
    $curseur->closeCursor();
} catch (PDOException $exc) {
    echo $exc->getTraceAsString();
}


include './PaysToTableWithFetchAllView.php';
?>
