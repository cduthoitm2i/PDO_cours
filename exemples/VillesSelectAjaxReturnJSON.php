<?php
    // --- VillesSelectAjax.php
// Pour accepter l'accès à des fichiers se trouvant dans un autre domaine (localhost) (par exemple dans htdocs et un autre dossier)
// A placer dans le fichier PHP lorsque l'on fait une requête sur ce fichier à partir d'un fichier JS
    header("Access-Control-Allow-Headers: *");
    // Requête json
    header("Content-Type: application/json; charset=UTF-8");
    // Requête de type get seulement
    header("Access-Control-Allow-Methods: GET");
    // On accepte les IP de toutes les machines
    header("Access-Control-Allow-Origin: *");

    $contenu = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        $select = "SELECT cp, nom_ville FROM villes";
        $curseur = $pdo->query($select);
        // le résultat du select dans un tableau ordinal de tableaux associatifs
        $enregistrements = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        // Transforme un tableau en JSON (ici un tableau ordinal d'objet contenant des objets JSON)
        $contenu = json_encode($enregistrements);

        $pdo = null;
    }
    catch(PDOException $e) {
        $t=array();
        $message=array();
        $message["cp"]="-1";
        $message["nom_ville"]=$e->getMessage();
        $t[0]=$message;
        $contenu = json_encode($t);
      }
    echo $contenu;
?>