<?php

declare(strict_types=1);
// --- SQL paramétré : VillesInsertCTRLWithFunctions.php
header("Content-Type: text/html; charset=UTF-8");

/**
 * 
 * @param string $host
 * @param string $db
 * @param string $user
 * @param string $pwd
 * @return PDO
 */
function getConnection(string $host, string $db, string $user, string $pwd): PDO {
    try {
        // --- Connexion ... dans tous les cas
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");
    } catch (PDOException $e) {
        echo $e;
        $pdo = null;
    }
    return $pdo;
}

/**
 * 
 * @param PDO $pdo
 * @param array $data
 * @return int
 */
function insert(PDO $pdo, array $data): int {
    try {
        $sql = "INSERT INTO villes(cp, nom_ville, id_pays) VALUES(?,?,?)";

        $statement = $pdo->prepare($sql);

        $statement->bindParam(1, $data["cp"], PDO::PARAM_STR);
        $statement->bindParam(2, $data["nomVille"], PDO::PARAM_STR);
        $statement->bindParam(3, $data["idPays"], PDO::PARAM_STR);

        $statement->execute();

        $affected = $statement->rowcount();
    } catch (Exception $e) {
        echo $e->getTraceAsString();
        $affected = -1;
    }
    return $affected;
}

$message = "";

$cp = filter_input(INPUT_POST, "cp");
$nomVille = filter_input(INPUT_POST, "nomVille");
$idPays = filter_input(INPUT_POST, "idPays");

if ($cp != null && $nomVille != null && $idPays != null) {
    /*
     * CALL CONNEXION
     */
    $pdo = getConnection("127.0.0.1", "cours", "root", "");
    /*
     * CALL INSERTION
     */
    $data = array("cp" => $cp, "nomVille" => $nomVille, "idPays" => $idPays);
    $message = insert($pdo, $data) . " enregistrement(s) ajouté(s)";

    $pdo = null;
} else {
    $message = "Toutes les saisies sont obligatoires";
}

include './VillesInsertIHM.php';