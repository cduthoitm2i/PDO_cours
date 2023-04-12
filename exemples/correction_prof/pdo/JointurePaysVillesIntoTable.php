<?php
/*
  JointurePaysVillesIntoTable.php
 */
header("Content-Type: text/html; charset=UTF-8");

$message = "";
$tableHTML = "";

try {
    // --- Tentative de connexion
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    // --- Attributs de connexion : erreur --> exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // --- Communication UTF-8 entre BD et script
    $pdo->exec("SET NAMES 'UTF8'");

    $select = "SELECT nom_pays, nom_ville FROM pays JOIN villes ON pays.id_pays = villes.id_pays";
    $select = "SELECT * FROM clients";
    $curseur = $pdo->query($select);
    // Les enregistrements sont vus comme des tableaux associatifs (et non pas comme des tableaux ordinaux)
    $curseur->setFetchMode(PDO::FETCH_ASSOC);

//    echo "<pre>";
//    var_dump($curseur);
//    echo "</pre>";
    // On boucle sur les lignes du curseur
    foreach ($curseur as $enregistrement) {
        $tableHTML .= "<tr>";
        // On boucle sur les colonnes de l'enregistrement courant
        foreach ($enregistrement as $valeur) {
            $tableHTML .= "<td>$valeur</td>";
        }
//        $tableHTML .= "<td>" . $enregistrement["nom_pays"] ."</td><td>" . $enregistrement[1] ."</td>";
        $tableHTML .= "</tr>";
    }

    $curseur->closeCursor();
} /// try
// --- Récupération d'une exception
catch (PDOException $e) {
    $message = "Echec de l'exécution : " . $e->getMessage();
} /// catch
// --- Deconnexion
$pdo = null;
?>


<table border="1">
    <thead>
    </thead>
    <tbody>
<?php
echo $tableHTML;
?>
    </tbody>
</table>

<label>
<?php
echo $message;
?>
</label>