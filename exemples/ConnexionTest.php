<?php
/*
 * ConnexionTest.php
 */
require_once './lib/Connexion.php';

$pdo = seConnecter("./conf/cours.ini");

echo "<br><pre>";
var_dump($pdo);
echo "</pre><br>";

seDeconnecter($pdo);
?>