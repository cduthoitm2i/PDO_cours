<?php

// --- SQL parametre : ProduitsInsertCTRL.php
header("Content-Type: text/html; charset=UTF-8");
$message = "";
// On récupère les informations saisies dans la balise input du fichier ProduitsInsertIHM.php
$btInsert = filter_input(INPUT_POST, "btInsert");
// On test si la valeur les valeurs dans les champs input sont vide
if ($btInsert != null) {
    // On filtre sur la colonne designation (récupération de toutes les valeurs)
    $designation = filter_input(INPUT_POST, "designation");
    // On filtre sur la colonne prix (récupération de toutes les valeurs)
    $prix = filter_input(INPUT_POST, "prix");
    // On commence les tests (si désignation et prix ne sont pas vide, alors on peut se connecter à la base de données, sinon on affiche le message "Toutes les saisies sont obligatoires")
    if ($designation != null && $prix != null) {
        try {
            /*
             * Connexion
             */
            $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET NAMES 'UTF8'");
            /*
             * INSERTION
             */
            // requête SQL
            $sql = "INSERT INTO produits(designation, prix) VALUES(?,?)";
            $statement = $pdo->prepare($sql);
            //  Lie un paramètre à un nom de variable spécifique 
            $statement->bindParam(1, $designation);
            $statement->bindParam(2, $prix);
            $statement->execute();
            // Retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute() 
            // Dans notre cas, ce sera toujours 1 puisque l'on ajoute une seule nouvelle entrée
            $message = $statement->rowcount() . " enregistrement(s) ajouté(s)<br />";
            // Affiche la dernière valeur de l'id ajoutée avec lastInsertId()
            $message .= "Le nouvel ID : " . $pdo->lastInsertId();

            $pdo = null;
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
    } else {
        $message = "Toutes les saisies sont obligatoires";
    }
}
include './ProduitsInsertIHM.php';