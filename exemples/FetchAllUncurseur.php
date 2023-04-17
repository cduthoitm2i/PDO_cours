<!DOCTYPE html>
<html>
    <head>
        <title>FetchAllUncurseur.php</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <?php
        $contenu = "";

        // Connexion
        $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        // Exécution de la requête
        $curseur = $pdo->query("SELECT * FROM pays");
        // --- Chargement de toutes les données
        $enregistrements = $curseur->fetchAll(PDO::FETCH_ASSOC);
        // --- Fermeture du curseur
        $curseur->closeCursor();

        // --- Boucle sur les données de Pays
        foreach ($enregistrements as $enregistrement) {
            $contenu .= $enregistrement['nom_pays'] . "<br/>\n";
        } /// Boucle pays
        ?>

        <div>
            <?php
            // --- Affichage
            echo $contenu;
            ?>
        </div>
    </body>
</html>