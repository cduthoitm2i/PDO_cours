<?php

/* VillesDAOProceduralTests.php */

require_once './lib/Connexion.php';
// Require_once caché pour l'instant
//require_once '../lib/Transaxion.php';
require_once './daos/VillesDAOProcedural.php';

$pdo = seConnecter("./conf/cours.ini");

// Première fonction
// on utilise la fonction selectAll (ligne 15) définie dans le fichier VillesDAOProcedural.php
echo "<hr>selectAll<hr>";
$content = "";
// Appel de la fonction selectAll
$lines = selectAll($pdo);

//    echo "<hr>";
//    echo "<pre>";
//    var_dump($lines);
//    echo "</pre>";
//    echo "<hr>";

foreach ($lines as $line) {
    foreach ($line as $field => $value) {
        // On insère des : entre les colonnes (ou informations)
        $content .= $field . ":" . $value . ";";
    }
    // Fonction php pour transformer en balise <br/>
    $content .= "\n";
}
echo nl2br($content);

// Deuxième fonction
// on utilise la fonction selectOne (ligne 37) définie dans le fichier VillesDAOProcedural.php
echo "<hr>selectOne<hr>";
$content = "";
// Appel de la fonction selectOne
$line = selectOne($pdo, "75011");
if ($line != null) {
    foreach ($line as $field => $value) {
        $content .= $value;
    }
    // Fonction php pour transformer en balise <br/>
    $content .= "\n";
    echo nl2br($content);
} else {
    echo "Une erreur s'est produite, veuillez téléphoner à votre administrateur de BD, monsieur Antonino !!!";
}

// Troisième fonction
// on utilise la fonction insert (ligne 65) définie dans le fichier VillesDAOProcedural.php
 echo "<hr>insert<hr>";
//$pdo->beginTransaction();
$tAttributesValues = array();
$tAttributesValues['cp'] = "59000";
$tAttributesValues['nom_ville'] = "Villeneuve";
$tAttributesValues['id_pays'] = "033";
// Appel de la fonction Insert
$affected = insert($pdo, $tAttributesValues);
echo "Insertion : $affected";
//$pdo->commit();


// Quatrième fonction
// on utilise la fonction insert (ligne 65) définie dans le fichier VillesDAOProcedural.php
echo "<hr>update<hr>";
//$pdo->beginTransaction();
$tAttributesValues = array();
$tAttributesValues['nom_ville'] = "Villeneuve";
$tAttributesValues['id_pays'] = "033";
// Appel de la fonction update
$affected = update($pdo, "99999", $tAttributesValues);
echo "Modification : $affected";
//$pdo->commit();



// Cinquième fonction
// on utilise la fonction insert (ligne 89) définie dans le fichier VillesDAOProcedural.php
echo "<hr>delete<hr>";
//    $pdo->beginTransaction();
$affected = delete($pdo, "78000");
echo "Suppression : $affected";
//    $pdo->commit();
$pdo = null;
?>