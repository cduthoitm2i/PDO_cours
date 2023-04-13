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
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'UTF8'");

    $select = "SELECT designation FROM produits";

    $curseur = $pdo->query($select);
    $curseur->setFetchMode(PDO::FETCH_NUM);

    $contenuListe = "";
    // On boucle sur les lignes en récupérant le contenu de la 1e colonnes
    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation
        $contenuListe .= "<option>";
        $contenuListe .= "$enregistrement[0]";
        $contenuListe .= "</option>\n\n";
    }

    // Fermeture du curseur (non facultatif)
    $curseur->closeCursor();
?>

<?php
    $contenuTable = "";
    /* Sélecteur SQL
         * SELECT DISTINCT clients.nom, produits.designation
          FROM ((cours.cdes cdes
          INNER JOIN cours.clients clients
          ON (cdes.id_client = clients.id_client))
          INNER JOIN cours.ligcdes ligcdes ON (ligcdes.id_cde = cdes.id_cde))
          INNER JOIN cours.produits produits
          ON (ligcdes.id_produit = produits.id_produit)
          WHERE (produits.designation = 'Evian')
         */

    $designation = filter_input(INPUT_GET, "designation");

    if ($designation != null) {
        $select = "SELECT DISTINCT id_produit, designation, prix, qte_stockee FROM produits WHERE id_produit;";

        // Préparation et exécution du SELECT SQL
        //$select = "SELECT cp, nom_ville FROM villes";
        $curseur = $pdo->query($select);
        $curseur->setFetchMode(PDO::FETCH_NUM);
        $contenuID = 0;
        $contenuPrix = 0;
        $contenuStock = 0;
        $contenuPhoto = 0;

        // On prépare l'affichage du tableau selon le choix du menu déroulant
        // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
        foreach ($curseur as $enregistrement) {
            // Récupération des valeurs par concaténation et interpolation
            $contenuID .= "$enregistrement[0]\n";
            $contenuPrix .= "$enregistrement[2]&nbsp;€\n";
            $contenuStock .= "$enregistrement[3]\n";
            $contenuPhoto .= "<img width='150' alt='image' src='./img/" . $enregistrement[3] . "'>\n";

        }

        // Fermeture du curseur (facultatif)
        $curseur->closeCursor();
    }
} /// try
// Gestion des erreurs
catch (PDOException $e) {
    $contenuSelect = "Echec de l'exécution : " . $e->getMessage();
} /// catch
// Déconnexion (facultative)
$pdo = null;
?>
<!-- Affichage du sélecteur -->

<body>
    <form action="" method="GET">
        <select name="designation">
            <?php
            echo $contenuListe;
            ?>
        </select>
        <input type="submit" value="Valider" />
    </form>
    <br>
    <h1>Fiche produit</h1>

    <table>
        <tbody>
            <tr>
                <td>Code produit&nbsp;:</td>
                <td>
                    <?php
                    // Affichage du contenu
                    echo $contenuID;
                    ?>
                </td>
            </tr>
            <tr>
                <td>Désignation&nbsp;:</td>
                <td>
                 <?php
                    // Affichage du contenu
                    echo $designation;
                    ?>
                </td>
            </tr>
            <tr>
                <td>Prix&nbsp;:</td>
                <td>
                <?php
                    // Affichage du contenu
                    echo $contenuPrix;
                    ?>
                </td>
                </td>
            </tr>
            <tr>
                <td>Stock&nbsp;:</td>
                <td>
                <?php
                    // Affichage du contenu
                    echo $contenuStock;
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <?php
                    // Affichage du contenu
                    echo $contenuPhoto;
                    ?>
                </td>
                </td>
            </tr>

        </tbody>
    </table>
</body>


</html>