<?php
// TableBD2GeneriqueCsv.php
header("Content-Type: text/html; charset=UTF-8");

$dbName = filter_input(INPUT_GET, "dbName");
$tableName = filter_input(INPUT_GET, "tableName");

$message = "";

if ($tableName != null && $dbName != null) {
    try {
        $pdo = new PDO("mysql:host=localhost;port=3306;dbname=information_schema;", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'UTF8'");

        $curseur = $pdo->query("SELECT * FROM $dbName.$tableName");
        $curseur->setFetchMode(PDO::FETCH_ASSOC);

        // Initialisations
        $entetes = "";
        $contenu = "";

        // Extraction du premier enregistrement pour récupérer les noms des colonnes et les valeurs du 1e enregistrement
        $ligne = $curseur->fetch();
        foreach ($ligne as $colonne => $valeur) {
            $entetes .= $colonne . ";";
            $contenu .= $valeur . ";";
        }
        // On enlève le dernier ;
        $entetes = substr($entetes, 0, -1);
        $contenu = substr($contenu, 0, -1);
        $entetes .= "\n";
        $contenu .= "\n";

        // On boucle sur les lignes de la table à partir de la 2ème ligne
        while ($ligne = $curseur->fetch()) {
            // On boucle sur les colonnes, on ne récupère que les valeurs
            foreach ($ligne as $valeur) {
                // On récupère les valeurs des colonnes
                $contenu .= $valeur . ";";
            }
            // On enlève le dernier ;
            $contenu = substr($contenu, 0, -1);
            // On ajoute le séparateur d'enregistrement
            $contenu .= "\n";
        }

        // On place les entêtes avant le contenu
        $contenu = $entetes . $contenu;

        $curseur->closeCursor();

        // Affichage
        $message = "C'est fini";
        file_put_contents($dbName . "_" . "$tableName.csv", $contenu);
    } catch (PDOException $e) {
        $message = "Echec de l'exécution : " . $e->getMessage();
    }

    $pdo = null;
} else {
    $message = 'Toutes les saisies sont obligatoires !!!';
}
?>


<form>
    <input type="text" name="dbName" value="cours" placeholder="Nom de la BD"/>
    <input type="text" name="tableName" value="pays" placeholder="Nom de la table"/>
    <input type="submit"  />
</form>

<hr>

<?php
echo $message;
?>
