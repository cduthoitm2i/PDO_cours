<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FicheProduit.php</title>
</head>
<?php
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
        // On utilise GET pour récupérer en même temps l'information du cp qui est envoyé dans le lien internet (bouton Envoyer)
        $contenuSelect .= "<form method='GET'><label>Ville&nbsp;? </label><select name='ville' id='ville'>\n";
        foreach ($curseur as $enregistrement) {
            // Récupération des valeurs par concaténation et interpolation
            $contenuSelect .= "<option value='$enregistrement[0]'>$enregistrement[1]</option>\n"; // ou $contenuSelect .= "<td>$enregistrement["nom_ville"]</td>\n";
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
<body>
    <form action="" method="">
        <label for="">Liste des produits&nbsp;: </label>
        <select name="designation" id="">
            <?php
            echo "$contenu";
            ?>
        </select>
        <input type="submit" value="valider">
    </form>
    <br>
    <h1>Fiche produit</h1>

        <table>
            <tbody>
                <tr>
                    <td>ID produit&nbsp;:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Désignation&nbsp;:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Prix&nbsp;:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Stock&nbsp;:</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <?php
                // Affichage du contenu
                echo $contenuSelect;
                ?>
            </tbody>
        </table>
    </body>


</html>