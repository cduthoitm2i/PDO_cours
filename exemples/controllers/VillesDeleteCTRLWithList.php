<?php

// --- SQL paramétré : VillesDeleteCTRLWithList.php
// Inclusion de la "bibliothèque" Connexion
require_once '../lib/Connexion.php';
// Inclusion de la "bibliothèque" du DAO
require_once '../daos/VillesDAOProcedural.php';

$message = "";
try {
    /*
     * Connexion
     */
    $pdo = seConnecter("../conf/cours.ini");

    /*
     * SUPPRESSION PAR APPEL DE LA FONCTION DU DAO
     */
    $cp = filter_input(INPUT_POST, "cp");
    if ($cp != null) {
        $pdo->beginTransaction();
        $affected = delete($pdo, $cp);
        if ($affected === 1) {
            $pdo->commit();
            $message = "Ville supprimée avec succès !!!";
        } else {
            if ($affected == 0) {
                $message = "Aucune Ville supprimée !!!";
            } else {
                $message = "Problème de suppression, veuillez contacter votre administrateur (Monsieur Antonino) !!!";
            }
        }
    }

    $options = "";
    $lines = selectAll($pdo);
    foreach ($lines as $line) {
        $options .= "<option value='{$line["cp"]}'>";
        $options .= $line["nom_ville"];
        $options .= "</option>";
        $options .= "\n";
    }


    $pdo = null;
} catch (PDOException $e) {
    $message = $e->getMessage();
}

// "Retour" à l'IHM
include '../VillesDeleteIHMWithList.php';