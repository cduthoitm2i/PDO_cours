<?php
    // --- VillesDeleteAJAX.php

    header("Content-Type: text/html; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Origin: *");

    // Fonction php avec deux arguments (constante PHP INPUT_POST et variable ou paramètre envoyé)
    $cp = filter_input(INPUT_POST, "cp");
    $lsMessage = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        // ? = paramétrage sur valeur inconnue pour éviter les injections SQL
        $sql = "DELETE FROM villes WHERE cp = ?";
        // on compile la requête
        $lcmd = $pdo->prepare($sql);
        // On exécute la requête (tableau de paramètre)
        $lcmd->execute(array($cp));

        // rowcount compte le nombre d'éléments supprimés 
        $lsMessage = $lcmd->rowcount() . " enregistrement(s) supprimé(s)";

        $pdo = null;
    }
    catch(PDOException $e) {
        $lsMessage = $e->getMessage();
    }
    echo $lsMessage;
?>