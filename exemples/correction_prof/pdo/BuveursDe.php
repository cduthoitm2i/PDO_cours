<!DOCTYPE html>
<!--
BuveursDe.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>BuveursDe.php</title>
    </head>

    <body>
        <?php
        $contenuSelect = "";
        /*
         * SELECT DISTINCT c.nom, p.designation
          FROM ((cdes cd
          INNER JOIN clients c
          ON (cd.id_client = c.id_client))
          INNER JOIN ligcdes l ON (l.id_cde = cd.id_cde))
          INNER JOIN produits p
          ON (l.id_produit = p.id_produit)
          WHERE (p.designation = 'Evian')
         */

        $designation = filter_input(INPUT_GET, "designation");
        // Méthode pour afficher tous les éléments si rien de renseigner dans le champ de saisie, 
        // mais faut ajouter  LIKE $designation dans la requête SQL
        $designation = "'" . $designation . "%'";
        
        //if ($designation != null) {
            $select = "SELECT DISTINCT clients.nom, produits.designation
  FROM ((cours.cdes cdes
         INNER JOIN cours.clients clients
            ON (cdes.id_client = clients.id_client))
        INNER JOIN cours.ligcdes ligcdes ON (ligcdes.id_cde = cdes.id_cde))
       INNER JOIN cours.produits produits
          ON (ligcdes.id_produit = produits.id_produit)
 WHERE (produits.designation LIKE $designation)";

            try {
                // Connexion
                $pdo = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec("SET NAMES 'UTF8'");

                // Préparation et exécution du SELECT SQL
                $curseur = $pdo->query($select);
                $curseur->setFetchMode(PDO::FETCH_NUM);

                // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
                foreach ($curseur as $enregistrement) {
                    // Récupération des valeurs par concaténation et interpolation
                    $contenuSelect .= "<tr>\n";
                    $contenuSelect .= "<td>$enregistrement[0]</td>\n";
                    $contenuSelect .= "<td>$enregistrement[1]</td>\n";
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
            $pdo = null;
        //}
        ?>

        <form action="" method="GET">
            <input type="text" name="designation" value="Evian" placeholder="Désignation ?"/>
            <input type="submit" value="Valider" />
        </form>

        <br/>

        <table border="1">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Produit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($contenuSelect)) {
                    echo $contenuSelect;
                }
                ?>
            </tbody>
        </table>


    </body>
</html>
