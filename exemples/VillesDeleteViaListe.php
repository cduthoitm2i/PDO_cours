<!DOCTYPE html>
<!-- VillesDeletePrepareeIHM.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesDeletePrepareeIHM</title>
    </head>
    <!-- Dans ce fichier uniquement lea structure HTML, on appel le fichier ProduitsInsertCTRL.php -->
    <body>
        <h1>VillesDeletePrepareeIHM</h1>
        <p>Suppression d'une ville</p>
        <form action="VillesDeletePrepareeCTRL.php" method="POST">
            <label>Quelle ville&nbsp;? </label>
            <input type="text" name="cp" value="75211" />
            <!-- le name="btInsert" est dans le premier test dans le fichier ProduitsInsertCTRL.php -->
            <input type="submit" name="btSup" />
        </form>
        <br />
        <label>
            <!-- On affiche le résultat du fichier ProduitsInsertCTRL.php -->
            <?php
            if (isSet($message) && $message != "") {
                echo $message;
            }
            ?>
        </label>
    </body>
</html>