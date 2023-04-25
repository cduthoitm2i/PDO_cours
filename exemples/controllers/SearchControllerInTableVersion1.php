<?php

/*
 * SearchControllerInDBVersion1.php
 * Moteur de recherche BD V1 :
 * sur une seule table de la BD cours ou une autre (Il suffit de changer la string de connexion) 
 * et sur toutes les colonnes de cette table
 */

/**
 * 
 * @param PDO $pdo
 * @param string $word
 * @param string $tableName
 * @return int
 */
function search(PDO $pdo, string $word, string $tableName): int {

    // Recuperation des noms des colonnes de la table
    // dans un tabeau
    $columnsArray = array();
    $sql = "SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='cours' AND TABLE_NAME='$tableName'";
    //$sql = "SHOW columns FROM $tableName";
    $cursor = $pdo->prepare($sql);
    $cursor->execute();
    foreach ($cursor as $record) {
        $columnsArray[] = $record[0];
    }
    $cursor->closecursor();

    // Recherche et comptage
    // On boucle sur toutes les colonnes de la table
    $count = 0;
    foreach ($columnsArray as $columnName) {
        $sql = "SELECT COUNT(*) FROM $tableName WHERE UPPER($columnName) LIKE ?";
        $cursor = $pdo->prepare($sql);
        $cursor->execute(array($word));
        $record = $cursor->fetch();
        $count += $record[0];
        $cursor->closecursor();
    }

    return $count;
}

/*
 * MAIN
 */
$searchWord = filter_input(INPUT_GET, "searchWord");
$tableName = filter_input(INPUT_GET, "tableName");

if ($searchWord != null && $tableName != null) {
    try {
        // Connexion
        $initFile = "../config/bd.ini";
        require_once '../daos/Connexion.php';
        $pdo = seConnecter($initFile);

        // Recuperation du mot recherche, mis en majuscules et entoure de %
        $searchWord = "%" . strtoupper($searchWord) . "%";

        // La recherche
        $count = search($pdo, $searchWord, $tableName);
        // L'affichage des resultats
        $result = "<strong>$searchWord</strong>, mot recherché dans la table <strong>$tableName</strong> a été trouvé <strong>$count</strong> fois";

        $pdo = null;
    } catch (PDOException $e) {
        $result = htmlentities($e->getMessage());
    }
} else {
    $result = "Toutes les saisies sont obligatoires";
}

include "../SearchViewVersion1UneTable.php"
?>
