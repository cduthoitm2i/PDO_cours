<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
</head>
<body>
    <!-- http://localhost/PDO_cours/exemples/catalogueView.php-->
    <?php
        // connexion BD
        require_once './lib/Connexion.php';
        $pdo = seConnecter("./conf/cours.ini");
        $sql = "SELECT * FROM produits";
        // Car pas de where
        $cursor = $pdo->query($sql);
        //
        $array = $cursor->fetchAll();
        $tbody = "";
        for($i=0; $i<count($array);$i++){
            $id_produit=$array[$i][0];
            $tbody .= "<tr>";
            $tbody .= "<td>";
            $tbody .= $array[$i][0];
            $tbody .= "</td>";
            $tbody .= "<td>";
            $tbody .= $array[$i][1];
            $tbody .= "</td>";
            $tbody .= "<td>";
            $tbody .= $array[$i][2];
            $tbody .= "</td>";
            $tbody .= "<td>";
            $tbody .= "<img height='50px' src='./img/" . $array[$i][4] . "'>";
            $tbody .= "</td>";
            $tbody .= "<td style='text-align:center'>";
            $tbody.= "<form>";
            //$tbody.= "<button type='submit' name='id_produit' value='$idProduit' ><img src='./img/caddie_gris.jpg' width='70'></button>";
            $tbody.="<a href='panierCTRL.php?id_produit=" . $array[$i][0] . "&designation=" . $array[$i][1] . "&prix=" . $array[$i][2] . "&photo=" . $array[$i][4] . "'><img height='50px' src='./img/caddie_gris.jpg' alt='Ajouter au caddie'></a>";
            $tbody.= "</form>";
            $tbody.= "</td>";
            $tbody .= "</tr>";
        }
    ?>


    <h1>Catalogue</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Code produit</th>
                <th>Désignation</th>
                <th>Prix (€)</th>
                <th>Photo</th>
                <th>Ajouter au panier</th>
            </tr>
        </thead>
        <tbody>

                <?php
                    echo $tbody;
                ?>
        </tbody>
    </table>
    <a href="panierView.php">Voir le panier</a>
</body>
</html>