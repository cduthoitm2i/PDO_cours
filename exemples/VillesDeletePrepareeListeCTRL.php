<?php

// --- SQL parametre : VillesDeletePrepareeListeCTRL.php
header("Content-Type: text/html; charset=UTF-8");
$message = "";
$btSup = filter_input(INPUT_POST, "btSup");
$cp = filter_input(INPUT_POST, "nom_ville");



/*
* Connexion à la base
*/
$pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET NAMES 'UTF8'");

// requête SQL
// On supprime donc à l'aide de cet syntaxe (on sélectionne le cp par rapport au nom de la ville dans la base villes)
$selectOption = "SELECT cp, nom_ville FROM villes";
$curseurOption = $pdo->query($selectOption);

// comme on doit afficher la liste déroulante, on place tous le code ici avant le test du clic sur le bouton de suppression
// On crée une liste par boucle ou l'on ajoute toutes les villes (en value on ajoute le code postal cp)
$contenuListe = "";
// On boucle sur les lignes en récupérant le contenu de la 1e colonnes
foreach ($curseurOption as $enregistrement) {
    // Récupération des valeurs par concaténation et interpolation
    $contenuListe .= "<option value='$enregistrement[0]'>";
    $contenuListe .= "$enregistrement[1]";
    $contenuListe .= "</option>\n\n";
}


// Ensuite, on test qu'il y a bien au moins un nom de ville sélectionné sinon on passe au message "Toutes les saisies sont obligatoires" 
if ($btSup != null) {
    // On filtre sur la colonne nom_ville (récupération de toutes les valeurs)
    if ($cp != null) {
        try {
            // On saisie la commande SQL de suppression de la ville selon le cp
            /*
             * SUPPRESSION
             */
            $sql = "DELETE FROM villes WHERE cp = ?";
            $statement = $pdo->prepare($sql);
            // paramètre PDO::PARAM_STR pas obligatoire
            $statement->bindParam(1, $cp, PDO::PARAM_STR);
            $statement->execute();


            // Retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute() 
            // Dans notre cas, ce sera toujours 1 puisque l'on ajoute une seule nouvelle entrée
            $message .= $statement->rowcount() . " enregistrement(s) supprimé(s)<br>";

            $pdo = null;
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
    } else {
        $message = "Toutes les saisies sont obligatoires";
    }
}
include 'VillesDeleteViaListe.php';
