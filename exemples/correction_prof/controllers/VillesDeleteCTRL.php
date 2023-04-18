<?php
// --- SQL paramétré : VillesDeleteCTRL.php
// Inclusion de la "bibliothèque" Connexion
require_once '../lib/Connexion.php';
// Inclusion de la "bibliothèque" du DAO
require_once '../daos/VillesDAOProcedural.php';

$message = "";

// Récupération des saisies utilisateur
$cp = filter_input(INPUT_POST, "cp");

// Test de la validité des saisies
if ($cp != null) {

    try {
        /*
         * Connexion
         */
        $pdo = seConnecter("../conf/cours.ini");

        /*
         * SUPPRESSION PAR APPEL DE LA FONCTION DU DAO
         */
        //$pdo->beginTransaction();
        // La fonction delete() du DAO
        $affected = delete($pdo, $cp);
        if ($affected === 1) {
            //$pdo->commit();
            $message = "Ville supprimée avec succès !!!";
        } else {
            if ($affected == 0) {
                $message = "Aucune Ville supprimée !!!";
            } else {
                $message = "Problème de suppression, veuillez contacter votre administrateur (Monsieur Antonino) !!!";
            }
        }

        $pdo = null;
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
} else {
    $message = "Toutes les saisies sont obligatoires";
}

// "Retour" à l'IHM
include '../VillesDeleteIHM.php';