<?php
// Récupère tous le contenu du panier
    $panier = filter_input(INPUT_COOKIE, "panier");
    echo "<hr>";

    $t = explode(" et ",$panier);
    echo "<pre>";
    var_dump($t);
    echo "</pre>";

    echo "<hr>";

    $table = "<table border='1'><thead><tr><th>ID</th><th>Désignation</th><th>Prix</th><th>Photo</th><th>Supprimer article</th></tr></thead><tbody>";
    for($i = 0; $i < count($t); $i++) {
        // $t est un tableau 1D
        // $t2 est un tableau 2D
        $table .= "<tr>";
        // Comme vu dans le catalogueView.php on utilise le # comme 
        $t2 = explode("#",$t[$i]);

        for($j = 0; $j < count($t2); $j++) {
        $table .= "<td>$t2[$j]</td>";
        }
        $table .= "<td> </td>";
        $table .= "</tr>";
    }
    $table .= "</tbody></table>";

    echo $table;
?>