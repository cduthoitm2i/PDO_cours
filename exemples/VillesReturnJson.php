<?php
    // --- VillesSelect.php
    header("Acces-Control-Allow-Headers: *");
    // requete de type GET seulement
    header("Access-Control-Allow-Methods: GET");
    // on accepte les ip de toutes les machines
    header("Access-Control-Allow-Origin: *");
    // on retourne du JSON
    header("Content-Type: application/json; charset=UTF-8");


    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        $select = "SELECT cp, nom_ville FROM villes";
        $curseur = $pdo->query($select);
        // le resultat du select dans un tableau ordinal de tableaux associatifs
        $enregistrements = $curseur->fetchAll(PDO:: FETCH_ASSOC);
        $curseur->closeCursor();
        // transforme un tableau en JSON(ici un tableau ordinal d'objets json) 
        $contenu = json_encode($enregistrements);

      
    }

    catch(PDOException $e) {
        $t=array();
        $message=array();
        $message["cp"]="-1";
        $message["nom_ville"]= $e->getMessage();
        $t[0]=$message;
        $contenu=json_encode($t);
    }
    $pdo=null;

    echo $contenu;
?>