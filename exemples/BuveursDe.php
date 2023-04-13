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
    // Important, il faut que les tables soient liées entre elle dans Concepteur de phpMyAdmin
    // Requête de test dans phpMyAdmin : SELECT DISTINCT c.nom, p.designation FROM clients c JOIN cdes cd JOIN ligcdes l JOIN produits p ON c.id_client = cd.id_client AND cd.id_cde = l.id_cde AND l.id_produit = p.id_produit;
    // La requête est ensuite copiée dans $select
    // Requête 1 : on affiche tous les clients et produits 
    // $select= "SELECT DISTINCT c.nom, p.designation FROM clients c JOIN cdes cd JOIN ligcdes l JOIN produits p ON c.id_client = cd.id_client AND cd.id_cde = l.id_cde AND l.id_produit = p.id_produit";
    // On affecte une variable $designation qui correspond à WHERE p.designation ='$designation' de la variable $select (en bout de ligne)
    $designation = filter_input(INPUT_GET, 'designation');
    // Requête 2 : on affiche tous les clients en sélectionnant un type de produit (voir la saisie dans le champ input)
    //  Si on saisi "Badoit", on a 4 clients affichés, si on saisit "Evian", on a 3 clients affichés, etc.
    // Ajouter d'une option, si rien n'est saisi, on affiche tout
    if ($designation == "" ||  $designation == NULL) {
        // "c, p, cd et l" sont des préfixes
        $select= "SELECT DISTINCT c.nom, p.designation FROM clients c JOIN cdes cd JOIN ligcdes l JOIN produits p ON c.id_client = cd.id_client AND cd.id_cde = l.id_cde AND l.id_produit = p.id_produit";
    } 
    else {
        $select = "SELECT DISTINCT c.nom, p.designation FROM clients c JOIN cdes cd JOIN ligcdes l JOIN produits p ON c.id_client = cd.id_client AND cd.id_cde = l.id_cde AND l.id_produit = p.id_produit WHERE p.designation ='$designation'";
    }
    // On peut faire la même chose avec un sélecteur (voir le fichier corrigé dans le dossier des corrigés dans le fichier portant le même nom, voir LIKE et %)
    // exécution du SELECT SQL
    $curseur = $cnx->query($select);


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
    <form action="" method="GET">
        <!-- Attention, la valeur name="designation" doit bien correspondre au nom de la variable définie plus haut -->
        <input type="text" name="designation" placeholder="Désignation ?">
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
                if(isset($contenuSelect)) {
                // Affichage du contenu
                echo $contenuSelect;
                }
                ?>
            </tbody>
        </table>
    </body>
</html>