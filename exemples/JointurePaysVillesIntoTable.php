<?php
// JointurePaysVillesIntoTable.php
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
    // Jointure de deux tables (villes et pays qui ont un identifiant commun)
    // Important, il faut que les tables soient liées entre elle dans Concepteur de phpMyAdmin
    // Tri par pays (en dessous dans commentaire tri par ville)
    // Important : on ajoute une clé v et p pour ensuite l'utiliser comme id
    // $select= "SELECT *FROM villes v JOIN pays p ON v.id_pays = p.id_pays ORDER BY p.nom_pays";
    //  $select= "SELECT *FROM villes v JOIN pays p ON v.id_pays = p.id_pays ORDER BY v.nom_ville";
    $select= "SELECT nom_pays, nom_ville FROM pays JOIN villes ON pays.id_pays = villes.id_pays";
    // exécution du SELECT SQL
    $curseur = $cnx->query($select);
    // Un enregistrement est un tableau ordinal
    //$curseur->setFetchMode(PDO::FETCH_NUM);
    // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation
        $contenuSelect .= "<tr>\n";
        $contenuSelect .= "<td>" . $enregistrement["nom_ville"] . "</td>\n";
        $contenuSelect .= "<td>" . $enregistrement["nom_pays"] . "</td>\n";
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
        <title>JointurePaysVillesIntoTable</title>
    </head>

    <body>
        <table border="1">
            <tbody>
                <?php
                // Affichage du contenu
                echo $contenuSelect;
                ?>
            </tbody>
        </table>
    </body>
</html>