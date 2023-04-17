<?php

/* VillesDAOProceduralTests.php */

require_once './lib/Connexion.php';
//require_once '../lib/Transaxion.php';
require_once 'VillesDAOProcedural.php';

$pdo = seConnecter("./conf/cours.ini");

echo "<hr>selectAll<hr>";
$content = "";
$lines = selectAll($pdo);

foreach ($lines as $line) {
    foreach ($line as $field => $value) {
        $content .= $field . ":" . $value . ";";
    }
    $content .= "\n";
}
echo nl2br($content);

echo "<hr>selectOne<hr>";
$content = "";
$line = selectOne($pdo, "75011");
foreach ($line as $field => $value) {
    $content .= "$field => $value<br/>";
}
$content .= "\n";
echo nl2br($content);

echo "<hr>insert<hr>";
//$pdo->beginTransaction();
$tAttributesValues = array();
$tAttributesValues['cp'] = "99998";
$tAttributesValues['nom_ville'] = "Test";
$tAttributesValues['id_pays'] = "033";
$affected = insert($pdo, $tAttributesValues);
echo "Insertion : $affected";
//$pdo->commit();


echo "<hr>delete<hr>";
//    $pdo->beginTransaction();
//    $affected = delete($pdo, "99999");
//    echo "Suppression : $affected";
//    $pdo->commit();

echo "<hr>update<hr>";
$tAttributesValues = array();
$tAttributesValues['nom_ville'] = "Lyon";
$tAttributesValues['id_pays'] = "033";
$affected = update($pdo, "69000", $tAttributesValues);
echo "Modification : $affected";

$pdo = null;
?>