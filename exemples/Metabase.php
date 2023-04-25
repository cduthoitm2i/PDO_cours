<?php

/*
 * Metabase.php
 * 
 * Mode : procedural
 */

/**
 * 
 * Renvoie un tableau : la liste des BDs d'un serveur
 * 
 * @param type $pdo
 * @return type
 */
function getBDsFromServeur(PDO $pdo) {
    $lsSelect = "SELECT SCHEMA_NAME FROM information_schema.schemata";
    return getTableau1DFromSelect($pdo, $lsSelect);
}

/**
 * 
 * Renvoie un tableau : la liste des tables d'une BD
 * 
 * @param PDO $pdo
 * @param type $psBD
 * @return type
 */
function getTablesFromBD(PDO $pdo, $psBD) {
    $lsSelect = "SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA='$psBD'";
    return getTableau1DFromSelect($pdo, $lsSelect);
}

/**
 * 
 * Renvoie un tableau : la liste des colonnes d'une table
 * 
 * @param PDO $pdo
 * @param type $psBD
 * @param type $psTable
 * @return type
 */
function getColumnsNamesFromTable($pdo, $psBD, $psTable) {
    $lsSelect = "SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$psBD' AND TABLE_NAME='$psTable'";
    return getTableau1DFromSelect($pdo, $lsSelect);
}

/**
 *
 * Renvoie un tableau : la liste des colonnes formant la PK d'une table
 *
 * @param type $pdo
 * @param type $psBD
 * @param type $psTable
 * @return type
 */
function getColumnsNamesPKFromTable($pdo, $psBD, $psTable) {
    $lsSelect = "";
    $lsSelect .= "SELECT COLUMN_NAME ";
    $lsSelect .= " FROM information_schema.columns ";
    $lsSelect .= " WHERE TABLE_SCHEMA='$psBD' AND TABLE_NAME='$psTable' AND COLUMN_KEY='PRI' ";

    return getTableau1DFromSelect($pdo, $lsSelect);
}

/**
 * 
* Renvoie un tableau : la liste des colonnes formant la FK
 *
 * @param type $pdo
 * @param type $psBD
 * @param type $psTable
 * @return type
 */
function getColumnsNamesFKFromTable($pdo, $psBD, $psTable) {

/*
  SELECT COLUMN_NAME
  FROM KEY_COLUMN_USAGE
  WHERE TABLE_SCHEMA = 'cours'
  AND TABLE_NAME = 'contributeur'
  AND REFERENCED_TABLE_NAME IS NOT NULL;
 */

$lsSelect = "SELECT COLUMN_NAME ";
$lsSelect .= " FROM information_schema.KEY_COLUMN_USAGE ";
$lsSelect .= " WHERE TABLE_SCHEMA = '$psBD' ";
$lsSelect .= " AND TABLE_NAME = '$psTable' ";
$lsSelect .= "AND information_schema.tables IS NOT NULL ";

return getTableau1DFromSelect($pdo, $lsSelect);
}


/**
 * 
 * @param type $pdo
 * @param type $psSelect
 * @return array
 */
function getTableau1DFromSelect($pdo, $psSelect) {
    $t1D = array();
    $cursor = null;
    try {
        $cursor = $pdo->prepare($psSelect);
        $cursor->execute();
        $cursor->setFetchMode(PDO::FETCH_NUM);
        foreach ($cursor as $line) {
            array_push($t1D, $line[0]);
        }
        $cursor->closeCursor();
    } catch (PDOException $e) {
        $cursor = null;
        array_push($t1D, $e->getMessage());
    }
    return $t1D;
}

?>