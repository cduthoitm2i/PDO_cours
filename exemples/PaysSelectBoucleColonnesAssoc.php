<!DOCTYPE html>
<!-- PaysSelectBoucleColonnesAssoc.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PaysSelectBoucleColonnesAssoc</title>
        <style>
            table{
                border-collapse: collapse;
                margin: 1em;
            }
            caption, th, td{
                border: 1px solid black;
            }
            td, th{
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <?php
        $message = "";
        $tableHTML = "";

        try {
            // --- Tentative de connexion
            $cnx = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
            // --- Attributs de connexion : erreur --> exception
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // --- Communication UTF-8 entre BD et script
            $cnx->exec("SET NAMES 'UTF8'");

            $curseur = $cnx->query("SELECT * FROM pays");
            $curseur->setFetchMode(PDO::FETCH_ASSOC);
            //$curseur->setFetchMode(PDO::FETCH_NUM);

            // On boucle sur les lignes du curseur
            foreach ($curseur as $enregistrement) {
                $tableHTML .= "<tr>";
                // On boucle sur les colonnes de l'enregistrement courant
                foreach ($enregistrement as $valeur) {
                    $tableHTML .= "<td>$valeur</td>";
                }
                $tableHTML .= "</tr>";
            }

            $curseur->closeCursor();
        } /// try
        // --- Récupération d'une exception
        catch (PDOException $e) {
            $message = "Echec de l'exécution : " . $e->getMessage();
        } /// catch
        // --- Deconnexion
        $cnx = null;
        ?>

        <?php
        if ($message == "") {
            ?>
            <table>
                <thead>
                </thead>
                <tbody>
                    <?php
                    echo $tableHTML;
                    ?>
                </tbody>
            </table>

            <?php
            if ($message == "") {

            }
        }
        ?>

        <label>
            <?php
            echo $message;
            ?>
        </label>
    </body>
</html>