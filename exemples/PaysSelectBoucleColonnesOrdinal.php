<?php
/*
  PaysSelectBoucleColonnesOrdinal.php
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

    $curseur = $pdo->query("SELECT * FROM pays");
    $curseur->setFetchMode(PDO::FETCH_NUM);

    // On boucle sur les lignes du curseur
    foreach ($curseur as $enregistrement) {
        $tableHTML .= "<tr>";
        // On boucle sur les colonnes de l'enregistrement courant
        $count = count($enregistrement);
        for ($i = 0; $i < $count; $i++) {
            $tableHTML .= "<td>$enregistrement[$i]</td>";
        }
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