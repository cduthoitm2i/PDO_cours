<!DOCTYPE html>
<!-- TableSQL2SelectHTML_version_template.php -->
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'UTF8'");

    $curseur = $pdo->query("SELECT id_pays AS ID, nom_pays AS Nom FROM pays");
    /*
     * Renvoie un tableau ordinal de tableaux ordinaux
     */
    $tOrdinal = $curseur->fetchAll(PDO::FETCH_NUM);
//    var_dump($tOrdinal);

    $curseur->closeCursor();
}
catch (PDOException $e) {
    $lsContents = "Echec de l'exécution : " . $e->getMessage();
}

$pdo = null;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Version template</title>
    </head>
    <body>
        <form>
            <select name="listePaysOrdinal">
                <?php
                for ($i = 0; $i < count($tOrdinal); $i++) {
                    ?>
                    <option value="<?= $tOrdinal[$i][0]; ?>">
                        <?= $tOrdinal[$i][1]; ?>
                    </option>
                    <?php
                }
                ?>
                <input type="submit" />
        </form>
    </body>
</html>