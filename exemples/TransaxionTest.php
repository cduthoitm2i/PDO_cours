<?php

/*
 * TransaxionTest.php
 */

require_once './lib/Connexion.php';
require_once './lib/Transaxion.php';

$pdo = seConnecter("./conf/cours.ini");

try {

    initialiser($pdo);

    $sql = "INSERT INTO pays(id_pays, nom_pays) VALUES(?,?)";

    $statement = $pdo->prepare($sql);

    $id = "SR";
    $nom = "Serbie";

    $statement->bindParam(1, $id, PDO::PARAM_STR);
    $statement->bindParam(2, $nom, PDO::PARAM_STR);

    $statement->execute();
    $rowCount = $statement->rowCount();
    echo "<br>Ligne(s) ajoutée(s) : $rowCount";

    //$lbOK = annuler($pdo);
    $lbOK = valider($pdo);
    echo "<br>$lbOK";
} catch (PDOException $exc) {
    echo $exc->getMessage();
    annuler($pdo);
}

seDeconnecter($pdo);
?>