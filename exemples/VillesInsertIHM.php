<!DOCTYPE html>
<!--
VillesInsertIHM.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesInsertIHM</title>
    </head>
    <body>
        <h3>INSERT</h3>
        <form action="VillesInsertCTRL.php" method="post">
            <label>CP </label>
            <!-- Il faut modifier la valeur de la value sinon au second passage il y a une erreur car l'info existe dans la table BD-->
            <input type="text" name="cp" value="75010" size="5" />
            <label>Ville </label>
            <input type="text" name="nomVille" value="Paris 10" />
            <label>ID pays </label>
            <input type="text" name="idPays" value="033" size="4" />

            <input type="submit" />
        </form>

        <br>

        <label>
            <?php
            if (isSet($message)) {
                echo $message;
            }
            ?>
        </label>
    </body>
</html>