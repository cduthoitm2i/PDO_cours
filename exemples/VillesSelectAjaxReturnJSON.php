<?php
    // --- VillesSelectAjax.php
// Pour accepter l'accès à des fichiers se trouvant dans un autre domaine (localhost) (par exemple dans htdocs et un autre dossier)
// A placer dans le fichier PHP lorsque l'on fait une requête sur ce fichier à partir d'un fichier JS
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Origin: *");

    $contenu = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        $select = "SELECT cp, nom_ville FROM villes";
        $curseur = $pdo->query($select);
        $enregistrements = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        $contenu = json_encode($enregistrements);

        $pdo = null;
    }
    catch(PDOException $e) {
        $contenu = $e->getMessage();
    }
    echo $contenu;
?>