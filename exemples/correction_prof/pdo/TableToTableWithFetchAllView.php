<!DOCTYPE html>
<!--
TableToTableWithFetchAllView
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>TableToTableWithFetchAllView</title>
</head>

<body>
    <h1>TableToTableWithFetchAllView</h1>

    <?php
    // Extraction du premier enregistrement pour récupérer les noms des colonnes et les valeurs du 1e enregistrement
    // On déclare la variable pour les entêtes et on place le contenu dans la balise html
    $headers = "";
    // On va de $column à $value
    foreach ($firstLine as $column => $value) {
        $headers .= "<th>" . $column . "</th>";
    }

    // Extraction des autres enregistrements et on affiche dans les balises html
    // On fait le corps du tableau
    // On boucle sur les colonnes à l'intérieur de la boucle pour les lignes
    $contents = "";
    foreach ($lines as $line) {
        $contents .= "<tr>";
        foreach ($line as $column) {
            $contents .= "<td>$column</td>";
        }
        $contents .= "</tr>";
    }
    ?>

    <form method="GET" action="./TableToTableWithFetchAllController.php">
        <input type="text" name="tableName" placeholder="Table ?" />
        <input type="submit" />
    </form>

    <br /><br />

    <table border="1">
        <thead>
            <tr>
                <?php
                echo $headers
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $contents;
            ?>
        </tbody>
    </table>


</body>

</html>