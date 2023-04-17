<?php
 /* PaysWithIniCTRL.php*/

 require_once './lib/Connexion.php';
/* On se connecte à l'aide de la fonction SeConnecter définie dans Connexion.php et on appelle le fichier de configuration de notre bd avec cours.ini*/
$pdo = seConnecter("./conf/cours.ini");

/* on sélectionne la base pays*/
$sql = "SELECT * FROM pays";
/* on sélectionne la base villes*/
/* $sql = "SELECT * FROM villes"; */
$cursor = $pdo->query($sql);

$contents = "";
foreach ($cursor as $line){
    /* On affiche que la première colonne du tableau (soit l'id des pays, si on veut afficher les pays, on met $line[1]) ou les deux infos séparées d'un espace*/
    /* $line[0] = id des pays*/
    /* $line[1] = nom des pays */
    $contents .= $line[0]. " " . $line[1]. "<br/>";

}

echo "$contents";
