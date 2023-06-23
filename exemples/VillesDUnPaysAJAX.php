<?php
    // --- VillesDUnPays.php
    header("Content-Type: text/plain; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Origin: *");

    $id = filter_input(INPUT_GET, "id");

    $contenu = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        $sql = "SELECT cp, nom_ville FROM villes WHERE id_pays = ?";
        $rs = $pdo->prepare($sql);
        $rs->execute(array($id));

        foreach($rs as $enr) {
            $contenu .= "$enr[0];$enr[1]\n<br/>";
        }

        if($contenu != "") {
            $contenu = substr($contenu, 0, -1);
        }

        $pdo = null;
    }
    catch(PDOException $e) {
        $contenu = $e->getMessage();
    }

    echo $contenu;
?>