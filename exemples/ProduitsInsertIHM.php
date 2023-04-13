<!DOCTYPE html>
<!-- ProduitsInsertIHM.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ProduitsInsertIHM</title>
    </head>
    <!-- Dans ce fichier uniquement lea structure HTML, on appel le fichier ProduitsInsertCTRL.php -->
    <body>
        <form action="ProduitsInsertCTRL.php" method="post">
            <label>Désignation </label>
            <input type="text" name="designation" value="Vichy Saint-Yorre" />
            <label>Prix </label>
            <input type="text" name="prix" value="2.1" />
            <!-- le name="btInsert" est dans le premier test dans le fichier ProduitsInsertCTRL.php -->
            <input type="submit" name="btInsert" />
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