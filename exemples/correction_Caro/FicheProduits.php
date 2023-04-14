<?php
// FicheProduit.php
// Déclaration d'une variable et affectation d'une chaîne vide
$contenuSelect = "";
$contenuTable = "";
$contenuLabel = "";

//  je récupére la variable de l'url
$idProduit = filter_input(INPUT_GET, 'idProduit');


// si la variable n'est pas null je poursuis le code


// On va essayer d'exécuter les commandes qui se trouvent entre le TRY et CATCH
try {
    // Connexion
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    // Les erreurs sont gérées comme des exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Le tuyau est en UTF8
    $pdo->exec("SET NAMES 'UTF8'");


    // Liste déroulante des boissons
    $selectOption = "SELECT id_produit,designation FROM produits";

    // pas de where alors requete query
    $curseurOption = $pdo->query($selectOption);

    foreach ($curseurOption as $enregistrement) {
        $contenuSelect .= "<option value='$enregistrement[0]'>$enregistrement[1]</option>\n";
    }

    if ($idProduit != NULL) {
        // Préparation et exécution du SELECT SQL
        $select = "SELECT id_produit, designation, prix, qte_stockee, photo FROM produits WHERE id_produit=?";

        // Comme on a un WHERE on utilise la methode (prepare,bind,execute)
        // On prépare
        $curseur = $pdo->prepare($select);
        // On bind les paramètres
        $curseur->bindParam(1, $idProduit);
        // On execute le code
        $curseur->execute();

        // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2

        $enregistrement = $curseur->fetch();
        // Récupération des valeurs par concaténation et interpolation

        // Version Tableau
        $contenuTable .= "<tr>\n";
        $contenuTable .= "<td>" . $enregistrement["id_produit"] . "</td>\n";
        $contenuTable .= "<td>" . $enregistrement["designation"] . "</td>\n";
        $contenuTable .= "<td>" . $enregistrement["prix"] . "</td>\n";
        $contenuTable .= "<td>" . $enregistrement["qte_stockee"] . "</td>\n";
        if ($enregistrement[4] == ""  || $enregistrement == null || !file_exists("../images/" . $enregistrement[4])) {
            $contenuTable .= "<td><img src='../images/notImage.jpg' img width=150px></td>\n";
        } else {
            $contenuTable .= "<td><img src='../images/$enregistrement[4]' alt='image' img width=150px></td>\n";
        }

        $contenuTable .= "</tr>\n";

        // Version label infos les uns en dessous des autres
        $contenuLabel .= "<label>Code Produit : </label> " . $enregistrement[0] . "<br>";
        $contenuLabel .= "<label>Désignation : </label>" . $enregistrement["designation"] . "<br>";
        $contenuLabel .= "<label>Prix : </label>" . $enregistrement["prix"] . " € <br>";
        $contenuLabel .= "<label>Stock : </label>" . $enregistrement["qte_stockee"] . "<br>";
        if ($enregistrement[4] == ""  || $enregistrement == null || !file_exists("../images/" . $enregistrement[4])) {
            $contenuLabel .= "<td><img src='../images/notImage.jpg' img width=200px></td>\n";
        } else {
            $contenuLabel .= "<td><img src='../images/$enregistrement[4]' alt='image' img width=150px></td>\n";
        }

        // Fermeture du curseur (facultatif)
        $curseur->closeCursor();
    }
    // fin du if ifproduits different de null

    $curseurOption->closeCursor();
}

// Gestion des erreurs
catch (PDOException $e) {
    $contenuTable = "Echec de l'exécution : " . $e->getMessage();
}
// }

// Déconnexion (facultative)
$cnx = null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <fieldset>
        <form action="" method="get">
            <label>Liste des produits</label>
            <select name="idProduit">
                <?php
                echo $contenuSelect;
                ?>
            </select>

            <input type="submit" value="Valider" />

        </form>
        <h2>Fiche produit</h2>
        <p>
            <?php
            echo $contenuLabel;
            ?>
        </p>
        <table border="1">
            <thead>
                <tr>
                    <th>IdProduit</th>
                    <th>Désignation</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Affichage du contenu
                echo $contenuTable;
                ?>
            </tbody>
        </table>


    </fieldset>

</body>

</html>