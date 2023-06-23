<?php
    // --- VillesSelectAjax.php
// Pour accepter l'accès à des fichiers se trouvant dans un autre domaine (localhost) (par exemple dans htdocs et un autre dossier)
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Origin: *");

    $contenu = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        $sql = "SELECT cp, nom_ville FROM villes";
        $rs = $pdo->prepare($sql);
        $rs->execute();

        foreach($rs as $enr) {
            $contenu .= "$enr[0];$enr[1]\n";
        }
        $contenu = substr($contenu, 0, -1);

        $pdo = null;
    }
    catch(PDOException $e) {
        $contenu = $e->getMessage();
    }

    echo $contenu;
?>