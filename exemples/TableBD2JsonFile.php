<?php

/*
 * TableBD2JsonFile.php
 */

try {

    $cnx = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cnx->exec("SET NAMES 'UTF8'");

    //$rs = $cnx->query("SELECT * FROM pays ORDER BY id_pays");
    $rs = $cnx->query("SELECT p.id_pays, p.nom_pays, v.nom_ville FROM pays p INNER JOIN villes v ON p.id_pays = v.id_pays");
    $rs->setFetchMode(PDO::FETCH_ASSOC);

    $tPays = $rs->fetchAll();

    $rs->closeCursor();

    $chaineJSON = json_encode($tPays);

    file_put_contents("pays_from_bd.json", $chaineJSON);
} catch (PDOException $e) {
    $lsPays = "Echec de l'exécution : " . $e->getMessage();
}

$cnx = null;

//  Re-lecture
echo "<hr>Re-lecture pour contrôle<hr>";

// Récupération du contenu du fichier sous forme de flux de caractères
$contenuFichier = file_get_contents("pays_from_bd.json");

$jsonObjet = json_decode($contenuFichier);

// Boucle sur les éléments du tableau
for ($i = 0; $i < count($jsonObjet); $i++) {
    // Affichage des valeurs des attributs de chaque élément
    echo $jsonObjet[$i]->id_pays . " : " . $jsonObjet[$i]->nom_pays . " : " . $jsonObjet[$i]->nom_ville . "<br>";
}
?>