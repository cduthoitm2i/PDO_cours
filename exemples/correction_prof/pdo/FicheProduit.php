<?php
/*
 * FicheProduit.php
 */
// Déclare et init
$contentList = "";
$productSheet = "";

// On essaie de travailler avec la BD
try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    // Les erreurs sont gérées comme des exceptions (syntaxe type pour tous les cas)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // bd <-> TUYAU <-> page
    $pdo->exec("SET NAMES 'UTF8'");

    // Récupération de la sélection dans la liste déroulante (affectation de la variable)
    $idProduit = filter_input(INPUT_GET, "productList");

    // Si l'utilisateur a cliqué sur le bouton SUBMIT
    // On test que idProduit n'est pas vide ou pas renseigné
    if ($idProduit != null) {
        // Le SELECT ONE
        // id_produit = ? permet de sélectionner tous les éléments de la liste 
        $selectOne = "SELECT * FROM produits WHERE id_produit = ?";
        // PREPARE, BIND, EXECUTE : compilation, valorisation, exécution
        // Compilation
        $cursor = $pdo->prepare($selectOne);
        // Valorisation
        $cursor->bindParam(1, $idProduit);
        // Exécution
        $cursor->execute();

        // Récupération éventuelle d'un enregistrement dans le curseur
        $record = $cursor->fetch();
        // Si un enregistrement correspond aux saisies a été trouvé
        if ($record !== FALSE) {
            $productSheet = "Code produit&nbsp;: " . $idProduit . "<br>";
            $productSheet .= "Désignation&nbsp;: $record[1]<br>";
            $productSheet .= "Prix&nbsp;: $record[2]&nbsp;€<br>";
            $productSheet .= "Stock&nbsp;: $record[3] unités<br>";
            if ($record[4] == "" || $record[4] == null || !file_exists("../img/" . $record[4])) {
                $productSheet .= "<img src='../img/pas_de_photo.jpg' alt='Photo' title='Pas de photo' width='100' /><br>";
            } else {
                $productSheet .= "<img src='../img/$record[4]' alt='Photo' title='$record[4]' width='100' /><br>";
            }
            $productSheet .= "Catégorie&nbsp;: $record[5]<br>";
        } else {
            $productSheet .= "Code produit $idProduit introuvable<br>";
        }
        // Fermeture du curseur (obligatoire)
        $cursor->closeCursor();
    }

    // Exécution du SELECT SQL qui récupère tous les produits (id et désignation)
    $selectAll = "SELECT id_produit, designation FROM produits";
    // QUERY
    $cursor = $pdo->query($selectAll);
    // curseur = tableau ordinal
    $cursor->setFetchMode(PDO::FETCH_NUM);

    // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
    // curseur = tableau 2D , enr = tableau 1D
    foreach ($cursor as $record) {
        // Récupération des valeurs par concaténation et interpolation
        $contentList .= "<option value='$record[0]'>$record[1]</option>\n";
    }
    // Fermeture du curseur (facultatif)
    $cursor->closeCursor();
}
// Gestion des erreurs
catch (PDOException $e) {
    // On affecte une constante littérale et on concatène le résultat de la méthode getMessage()
    // de l'objet $e de la classe PDOException
    $contentSelect = 'Echec de l\'exécution : ' . $e->getMessage();
}

// Déconnexion (facultative)
$pdo = null;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FicheProduit.php</title>
    </head>

    <body>
        <form>
            
            <label for="productList">Produit ?</label>
            <!-- La liste déroulante-->
            <select name="productList">
                <option value="0">Quel produit ? </option>
                <?php
                // L'affichage des options de la liste déroulante
                echo $contentList;
                ?>
            </select>
            <input type="submit" value="Valider" />
        </form>
        <br/>
        <p>
            <?php
            // L'affichage du produit sélectionné
            echo $productSheet;
            ?>
        </p>
    </body>
</html>
