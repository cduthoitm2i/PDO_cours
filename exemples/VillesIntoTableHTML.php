<?php
// VillesIntoTableHTML.php
// Déclaration d'une variable et affectation d'une chaîne vide
$contenuSelect = "";
// On va essayer d'exécuter les commandes qui se trouvent entre le TRY et CATCH
try {
    // Connexion
    $cnx = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    // Les erreurs sont gérées comme des exceptions
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Le tuyau est en UTF8
    $cnx->exec("SET NAMES 'UTF8'");

    // Préparation et exécution du SELECT SQL
    $select = "SELECT cp, nom_ville FROM villes";
    // exécution du SELECT SQL
    $curseur = $cnx->query($select);
    // Un enregistrement est un tableau ordinal
    //$curseur->setFetchMode(PDO::FETCH_NUM);
    // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2


    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation
        $contenuSelect .= "<tr>\n";
        $contenuSelect .= "<td>" . $enregistrement["cp"] . "</td>\n";
        $contenuSelect .= "<td>$enregistrement[1]</td>\n";
        $contenuSelect .= "</tr>\n";
    }

    // Fermeture du curseur (facultatif)
    $curseur->closeCursor();
}
// Gestion des erreurs
catch (PDOException $e) {
    $contenuSelect = "Echec de l'exécution : " . $e->getMessage();
}

// Déconnexion (facultative)
$cnx = null;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesIntoTableExoV1Bis</title>
    </head>

    <body>
        <table border="1">
            <thead>
                <tr>
                    <th>CP</th>
                    <th>Ville</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Affichage du contenu
                echo $contenuSelect;
                ?>
            </tbody>
        </table>
    </body>
</html>