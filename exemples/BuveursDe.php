<?php
// BuveursDe.php
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
    // Requête de test dans phpMyAdmin : SELECT DISTINCT c.nom, p.designation FROM clients c JOIN cdes cd JOIN ligcdes l JOIN produits p ON c.id_client = cd.id_client AND cd.id_cde = l.id_cde AND l.id_produit = p.id_produit;
    // La requête est ensuite copiée dans $select
    $select= "SELECT DISTINCT c.nom, p.designation FROM clients c JOIN cdes cd JOIN ligcdes l JOIN produits p ON c.id_client = cd.id_client AND cd.id_cde = l.id_cde AND l.id_produit = p.id_produit";
    // exécution du SELECT SQL
    $curseur = $cnx->query($select);




    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation

        $contenuSelect .= "<tr>\n";
        $contenuSelect .= "<td>" . $enregistrement[0] . "</td>\n";
        $contenuSelect .= "<td>$enregistrement[1]</td>\n";
        $contenuSelect .= "</tr>\n";
    }  





    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation
        $contenuSelect .= "<tr>\n";
        $contenuSelect .= "<td>" . $enregistrement[0] . "</td>\n";
        $contenuSelect .= "<td>" . $enregistrement[1] . "</td>\n";
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
        <title>BuveursDe.php</title>
    </head>

    <body>
    <form action="">
        <input type="text" name="designation">
        <input type='submit' value='Envoyer'>
    </form>
    <br>
    <br>


    <table border="1">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Produit</th>
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