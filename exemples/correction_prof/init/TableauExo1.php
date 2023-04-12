<!DOCTYPE html>
<!--
TableauExo1
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TableauExo1</title>
    </head>
    <body>
        <h1>TableauExo1</h1>
        <select>
            <?php
            $tMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

            for ($i = 0; $i < count($tMois); $i++) {
                echo "<option>$tMois[$i]</option>";
            }
            ?>
        </select>
        <br><br>
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
    </body>
</html>
