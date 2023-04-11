<?php
// VillesIntoSelect.php
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
    $select = "SELECT cp, nom_ville, site, photo, id_pays FROM villes";
    // exécution du SELECT SQL
    $curseur = $cnx->query($select);
    // Un enregistrement est un tableau ordinal
    //$curseur->setFetchMode(PDO::FETCH_NUM);
    // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
    $contenuSelect .= "<form method='POST'><label>Ville&nbsp;? </label><select name='ville' id='ville'>\n";
    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation
       
        for ($i = $curseur; $i <= $enregistrement; $i++) {
        }
        $contenuSelect .= "<option>$enregistrement[1]</option>\n"; // ou $contenuSelect .= "<td>$enregistrement["nom_ville"]</td>\n";
        
    }
    
    $contenuSelect .= "</select>&nbsp;<input type='submit' value='Envoyer'>\n</form>";
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
        <title>VillesIntoSelect</title>
    </head>

    <body>
        
                <?php
                // Affichage du contenu
                echo $contenuSelect;
                ?>
          
    </body>
</html>