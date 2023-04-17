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
        <h1>PaysToTableWithFetchAllView</h1>

        <?php
        $contenu = "";
        foreach ($enregistrements as $enregistrement) {
            $contenu .= "<tr><td>$enregistrement[0]</td><td>$enregistrement[1]</td></tr>";
        }
        ?>

        <table border="1">
            <thead>
                <tr>
                    <th>ID Pays</th>
                    <th>Nom du pays</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo $contenu;
                ?>
            </tbody>
        </table>


    </body>
</html>
