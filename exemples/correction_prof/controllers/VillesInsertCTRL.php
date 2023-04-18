<?php
// --- SQL paramétré : VillesInsertCTRL.php
// Inclusion de la "bibliothèque" Connexion
require_once '../lib/Connexion.php';
// Inclusion de la "bibliothèque" du DAO
require_once '../dao/VillesDAOProcedural.php';

$message = "";

// Récupération des saisies utilisateur
$cp = filter_input(INPUT_POST, "cp");
$nomVille = filter_input(INPUT_POST, "nomVille");
$idPays = filter_input(INPUT_POST, "idPays");

// Test de la validité des saisies
if ($cp != null && $nomVille != null && $idPays != null) {

    try {
        /*
         * Connexion
         */
         $pdo = seConnecter("../conf/cours.ini");
        /*
         * INSERTION PAR APPEL DE LA FONCTION DU DAO
         */
        //$pdo->beginTransaction();
        $tAttributesValues = array();
        // Ajout d'items dans le tableau et affectation des saisies
        $tAttributesValues['cp'] = $cp;
        $tAttributesValues['nom_ville'] = $nomVille;
        $tAttributesValues['id_pays'] = $idPays;
        // Appel de la fonction du DAO
        $affected = insert($pdo, $tAttributesValues);
        if ($affected === 1) {
            //$pdo->commit();
            $message = "Nouvelle ville ajoutée avec succès !!!";
        } else {
            //$pdo->rollback();
            $message = "Problème d'insertion, veuillez contacter votre administrateur (Monsieur Antonino) !!!";
        }

        $pdo = null;
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
} else {
    $message = "Toutes les saisies sont obligatoires";
}

// "Retour" à l'IHM
include '../VillesInsertIHM.php';

