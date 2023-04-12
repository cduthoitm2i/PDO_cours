<?php
// Déclaration d'une variable et affactation une chaîne vide
$contenuSelect = "";
// On va essayer d'exécuter les commandes qui se trouvent entre le TRY et CATCH
try {
    // Connexion
    // Connexion
    $cnx = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    // Les erreurs sont gérées comme des exceptions
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Le tuyau est en UTF8
    $cnx->exec("SET NAMES 'UTF8'");

    // Préparation et exécution du SELECT SQL
    $select = "SELECT * FROM villes";
    // Exécution du SELECT SQL
    $curseur = $cnx->query($select);
    // Un enregistrement est un tableau ordinal
    $curseur->setFetchMode(PDO::FETCH_NUM);
    // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation
        //$contenu .= "$enregistrement[0]-$enregistrement[1]<br>";
        $contenuSelect .= "<tr>\n";
        $contenuSelect .= "<td>" . $enregistrement[0] . "</td>\n";
        $contenuSelect .= "<td>$enregistrement[1]</td>\n";
        // La balise <a href='url' >texte</a>
        // <a href="https://example.com">Website</a>
        $contenuSelect .= "<td><a href='http://" . $enregistrement[2] . "' target='_blank' />le site de $enregistrement[1]</a></td>\n";
        // La balise IMG <img src='chemin/ressource' alt='Texte alternatif' width='number' />
        if ($enregistrement[3] == "" || $enregistrement[3] == NULL || !file_exists("../images/" . $enregistrement[3])) {
            $contenuSelect .= "<td><img src='../images/pas_de_photo.png' width='100' alt='Photo'/></td>\n";
        } else {
            $contenuSelect .= "<td><img src='../images/$enregistrement[3]' width='100' alt='Photo'/></td>\n";
        }
        $contenuSelect .= "<td>" . $enregistrement[4] . "</td>\n";
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
        <title>VillesIntoTableExoImageURL</title>
    </head>

    <body>
        <table border="1">
            <thead>
                <tr>
                    <th>CP</th>
                    <th>Ville</th>
                    <th>Site</th>
                    <th>Photo</th>
                    <th>ID Pays</th>
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
