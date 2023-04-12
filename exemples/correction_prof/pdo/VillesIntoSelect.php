<?php
// déclare et init
$message = "";
$options = "";

// on essaie de travailler avec la BD
try {
    // Connexion
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    // Les erreurs sont gérées comme des exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // bd <-> TUYAU <-> page
    $pdo->exec("SET NAMES 'UTF8'");

    // Exécution du SELECT SQL
    $select = "SELECT cp, nom_ville FROM villes";
    $curseur = $pdo->query($select);
    // curseur = tableau ordinal
    //$curseur->setFetchMode(PDO::FETCH_NUM);
    // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
    // curseur = tableau 2D , enr = tableau 1D
    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation
        $options .= "<option value='$enregistrement[0]'>$enregistrement[1]</option>\n";
    }
    // Fermeture du curseur (facultatif)
    $curseur->closeCursor();
}
// Gestion des erreurs
catch (PDOException $e) {
    // On affecte une constante littérale et on concatène le résultat de la méthode getMessage()
    // de l'objet $e de la classe PDOException
    $message = 'Echec de l\'exécution : ' . $e->getMessage();
}

// Déconnexion (facultative)
$pdo = null;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesIntoSelect</title>
    </head>

    <body>
        <!--        un formulaire de saisie-->
        <form action="" method="GET">
            <label for="villes">Ville ?</label>
            <select name="villes">
                <?php
                echo $options;
                ?>
            </select>
            <input type="submit" value="Valider" />
        </form>
        <?php
        echo $message;
        ?>
    </body>
</html>
