<?php
// FetchAllGenerique.php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cours", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'UTF8'");

    // Initialisations
    $contenu = "";
    $entetes = "<strong>";

    $curseur = $pdo->query("SELECT * FROM pays");
    // $curseur = $pdo->query("SELECT * FROM villes");
    // $curseur = $pdo->query("SELECT cp, nom_ville, id_pays FROM villes");
    $curseur->setFetchMode(PDO::FETCH_ASSOC);

    $tableauDeDonnees = $curseur->fetchAll();

    /*
     * Avec les metadata mais ne fonctionne pas avec tous les pilotes
     */
    $colCompte = $curseur->columnCount();
    for ($i = 0; $i < $colCompte; $i++) {
        $metaDataArray = $curseur->getColumnMeta($i);
        $entetes .= "{$metaDataArray['name']}-";
    }
    $entetes = substr($entetes, 0, -1) . "</strong>";

    $curseur->closeCursor();

    foreach ($tableauDeDonnees as $enregistrement) {
        foreach ($enregistrement as $valeur) {
            $contenu .= $valeur . "-";
        }
        $contenu = substr($contenu, 0, -1);
        $contenu .= "<br>\n";
    } /// Boucle
    $entetes .= "<br>";
    // On place les entetes avant le contenu
    $contenu = $entetes . $contenu;

}
catch (PDOException $e) {
    $contenu = "Echec de l'exécution : " . $e->getMessage();
}

// Affichage
echo $contenu;

$pdo = null;
?>