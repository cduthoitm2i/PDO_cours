<!DOCTYPE html>
<!-- VillesDeleteViaListe.php.php -->
<html>

<head>
    <meta charset="UTF-8">
    <title>VillesDeleteViaListe</title>
</head>
<!-- Dans ce fichier uniquement lea structure HTML, on appel le fichier ProduitsInsertCTRL.php -->

<body>
    <!-- On ajoute un appel au fichier php avant pour lire la liste des villes -->
    
    <?php
        // require_once "VillesDeletePrepareeListeCTRL.php";
    ?>
    <h1>VillesDeleteViaListe</h1>
    <p>Suppression d'une ville</p>
    <form action="VillesDeletePrepareeListeCTRL.php" method="POST">
        <label>Quelle ville&nbsp;? </label>
        <select name="nom_ville">
            <?php
               echo $contenuListe;
            ?>
        </select>
        <!-- le name="btInsert" est dans le premier test dans le fichier ProduitsInsertCTRL.php -->
        <input type="submit" name="btSup" />
    </form>
    <br />
    <label>
        <!-- On affiche le résultat du fichier ProduitsInsertCTRL.php -->
        <?php
        if (isset($message) && $message != "") {
            echo $message;
        }
        ?>
    </label>
</body>

</html>