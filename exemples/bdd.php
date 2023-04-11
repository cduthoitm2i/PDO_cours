<?php
    // --- VillesSelect.php
    header("Content-Type: text/html; charset=UTF-8");

    try {
        // Connexion
        $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        // Préparation et exécution du SELECT SQL
        $select = "SELECT cp, nom_ville FROM villes";
        $curseur = $pdo->query($select);
        $curseur->setFetchMode(PDO::FETCH_NUM);

        $contenu = "";

        // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
        foreach($curseur as $enregistrement) {
            // Récupération des valeurs par concaténation et interpolation
            $contenu .= "$enregistrement[0]-$enregistrement[1]<br>";
        }
        // Fermeture du curseur (facultatif)
        $curseur->closeCursor();
    }
    // Gestion des erreurs
    catch(PDOException $e) {
        $contenu = "Echec de l'exécution : " . $e->getMessage();
    }

    // Déconnexion (facultative)
    $pdo = null;

    // Affichage du contenu
    echo $contenu;

?>