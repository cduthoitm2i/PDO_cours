<!DOCTYPE html>
<!--
BuveursDeAvecListeProduits.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>BuveursDeAvecListeProduits</title>
    </head>

    <body>
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
            /*
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
                $select = "SELECT DISTINCT clients.nom, produits.designation
  FROM ((cours.cdes cdes
         INNER JOIN cours.clients clients
            ON (cdes.id_client = clients.id_client))
        INNER JOIN cours.ligcdes ligcdes ON (ligcdes.id_cde = cdes.id_cde))
       INNER JOIN cours.produits produits
          ON (ligcdes.id_produit = produits.id_produit)
 WHERE (produits.designation = '$designation')";

                // Préparation et exécution du SELECT SQL
                //$select = "SELECT cp, nom_ville FROM villes";
                $curseur = $pdo->query($select);
                $curseur->setFetchMode(PDO::FETCH_NUM);

                // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
                foreach ($curseur as $enregistrement) {
                    // Récupération des valeurs par concaténation et interpolation
                    $contenuTable .= "<tr>\n";
                    $contenuTable .= "<td>$enregistrement[0]</td>\n";
                    $contenuTable .= "<td>$enregistrement[1]</td>\n";
                    $contenuTable .= "</tr>\n";
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

        <form action="" method="GET">
            <select name="designation">
                <?php
                echo $contenuListe;
                ?>
            </select>
            <input type="submit" value="Valider" />
        </form>
        
        <br/>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Produit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($contenuTable)){
                    echo $contenuTable;
                }
                ?>
            </tbody>
        </table>

    </body>
</html>
