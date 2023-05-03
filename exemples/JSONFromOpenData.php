<?php
 
/*
* JSONFromOpenData.php
*/
 
$contenuFichier = file_get_contents("https://opendata.paris.fr/api/explore/v2.1/catalog/datasets/velib-disponibilite-en-temps-reel/exports/json?lang=fr&timezone=Europe%2FBerlin");
 
//echo $contenuFichier;
 
$jsonObjet = json_decode($contenuFichier, true);
//
//echo "<pre>";
//var_dump($jsonObjet);
//echo "</pre>";
 
// Boucle sur les éléments du tableau
for ($i = 0; $i < count($jsonObjet); $i++) {
    // Affichage des valeurs des attributs de chaque élément
    echo $jsonObjet[$i]["name"] . " : " . $jsonObjet[$i]["capacity"] . "<br>";
}
