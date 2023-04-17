<!DOCTYPE html>
<!--
TableToTableWithFetchAllView
-->
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <h1>TableToTableWithFetchAllView</h1>

    <?php
    $contenu = "";


    foreach ($enregistrements as $enregistrement) {
        $contenu .= "<tr>";
        foreach ($enregistrement as $colonne) {
            $contenu .= "<td>$colonne</td>";
        }
        $contenu .= "</tr>";
    }
    ?>

    <form method="GET" action="./TableToTableWithFetchAllController.php">
        <input type="text" name="tableName" placeholder="Table ?" />
        <input type="submit" />
    </form>

    <br /><br />

    <table border="1">
        <thead>
        
        </thead>
        <tbody>
            <?php
            echo $contenu;
            ?>
        </tbody>
    </table>


</body>

</html>