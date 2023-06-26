<?php
//    http://localhost/jquery/php/PaysSelect.php

    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    
    $contenu = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");
        // requete tester ok
        $select = "SELECT id_pays,nom_pays FROM pays";
        $curseur = $pdo->query($select);
        // le resultat du select dans un tableau ordinal de tableaux associatifs
        $enregistrements = $curseur->fetchAll(PDO:: FETCH_ASSOC);
        $curseur->closeCursor();
        // transforme un tableau en JSON(ici un tableau ordinal d'objets json) 
        $contenu = json_encode($enregistrements);
        $pdo = null;
    }
    catch(PDOException $e) {
        $t=array();
        $message=array();
        $message["id_pays"]="-1";
        $message["nom_pays"]= "Erreur serveur , merci de contacter votre administrateur";
        $t[0]=$message;
        $contenu=json_encode($t);
    }
    echo $contenu;

?>
