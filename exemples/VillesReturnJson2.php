<?php
    // --- VillesSelect.php
    header("Acces-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $cp = filter_input(INPUT_GET,"cp");
    $contenu = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");
        // requete sql tester
        $select = "SELECT cp,nom_ville,id_pays FROM villes WHERE cp=?";
        $curseur = $pdo->prepare($select);
        $curseur->bindValue(1,$cp);
        $curseur->execute();
        //on récup le premier enregistrement du curseur dans un tableau associatif
        $enregistrement = $curseur->fetch(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        // FICHIER ENCODE OK -transforme le tableau associatif en objet json
        $contenu = json_encode($enregistrement);

        
       
        // Renvoie un tableau associatifs
    // $list = $cursor->fetchAll();

      
    }
    catch(PDOException $e) {
        $message=array();
        $message["cp"]="-1";
        $message["nom_ville"]= $e->getMessage();
        $contenu = json_encode($message);
    }
    $pdo=null;

    echo $contenu;
?>