<!DOCTYPE html>
<!--
SearchViewVersion1.php
Rechercher un mot dans UNE table
On affiche le nombre de fois où le mot a été trouvé
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Moteur de recherche BD 1.0</h1>

        <form action="../controllers/SearchControllerInTableVersion1.php" method="GET">
            <label>Mot recherché </label>
            <input type="text" name="searchWord" value="paris" placeholder="Mot recherché ?" />
            <label> dans la table </label>
            <input type="text" name="tableName" value="villes" placeholder="Quelle table ?" />

            <input type="submit" />
        </form>

        <p>
            <?php
            if (isSet($result)) {
                echo $result;
            }
            ?>
        </p>
    </body>
</html>
