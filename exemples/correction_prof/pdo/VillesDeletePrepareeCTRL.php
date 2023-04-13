<?php

// --- VillesDeletePrepareeCTRL.php
//header("Content-Type: text/html; charset=UTF-8");
$message = "";
$btValider = filter_input(INPUT_POST, "btValider");
$cp = filter_input(INPUT_POST, "cp");
if ($btValider != null) {
    if ($cp != null) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=cours', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET NAMES 'UTF8'");

            $sql = "DELETE FROM villes WHERE cp = ?";

            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $cp, PDO::PARAM_STR);
            $statement->execute();

            $message .= $statement->rowcount() . " enregistrement(s) supprimé(s)";

            $pdo = null;
        } // fin try
        catch (PDOException $e) {
            $message .= $e->getMessage();
        }
    } else {
        $message .= "Veux-tu bien saisir !!!";
    }
}

include './VillesDeletePrepareeIHM.php';
?>
