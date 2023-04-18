<!DOCTYPE HTML>
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
        <!-- Requête vers le contrôleur -->
        <form action="../controllers/VillesInsertCTRL.php" method="post" id="formInsert">
            <label>CP </label>
            <input type="text" name="cp" id="cp" value="75021" size="5" />
            <label>Ville </label>
            <input type="text" name="nomVille" id="nomVille" value="Paris 21" />
            <label>ID pays </label>
            <input type="text" name="idPays" id="idPays" value="033" size="4" />

            <input type="submit" />
<!--            <input type="button" value="Valider l'insertion" id="btInsert"/> -->
        </form>

        <br>

        <label>
            <?php
            if (isSet($message)) {
                echo $message;
            }
            ?>
        </label>

        <label id="messageJS"></label>

        <script>
            document.getElementById("btInsert").onclick = function () {
                console.log("btInsert");
                let cp = document.getElementById("cp").value;
                let nomVille = document.getElementById("nomVille").value;
                let idPays = document.getElementById("idPays").value;

                if (cp === "" || nomVille === "" || idPays === "") {
                    document.getElementById("messageJS").innerHTML = "Toutes les saisies sont obligatoires";
                } else {
                    document.getElementById("formInsert").submit();
                }
            };
        </script>
    </body>
</html>